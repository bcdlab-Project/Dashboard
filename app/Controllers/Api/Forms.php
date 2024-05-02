<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Forms extends Controller
{
    use ResponseTrait;
    
    public function getIndex() { return $this->failUnauthorized(); }

    public function getParticipation($id = false, $action = false) {
        helper('permissions');
        $request = service('request');

        if (!admin_Permission()) { return $this->failUnauthorized(); }

        $show = $request->getGet("show") == null ? 50 : $request->getGet("show");
        $start = $request->getGet("start") == null ? 0 : $request->getGet("start");

        if (!$id && !$action) {
            $status = $request->getGet("status") == null ? false : $request->getGet("status");

            $query = model('FormModel')->where('type', 1)->join('ParticipationForms','Forms.id = ParticipationForms.id')->join('FormEvaluations', 'Forms.id = FormEvaluations.form','left')->orderBy('created_at','DESC');

            if ($status) {
                if ($status == 'pending') {
                    $query->where('approved', null);
                } else if ($status == 'approved') {
                    $query->where('approved', 1);
                } else if ($status == 'rejected') {
                    $query->where('approved', 0);
                }
            }

            $total = $query->countAllResults(false);
            $submissions = $query->findAll($show,$start);

            $output = [];

            foreach ($submissions as $submission) {
                $output[] = [
                    'id'=>$submission['id'],
                    'username'=>$submission['requested_username'],
                    'email'=>$submission['requested_email'],
                    'email_verified'=>$submission['email_verified'] == 1,
                    'created_at'=>$submission['created_at'],
                    'status'=>$submission['approved'] == null ? 'pending' : ($submission['approved'] == 1 ? 'approved' : 'rejected'),
                    'approved'=>$submission['approved'] == 1,
                    'more_info'=>'https://dash.bcdlab.xyz/api/forms/participation/' . $submission['id']
                ];
            }

            return $this->setResponseFormat('json')->respond(['ok'=>true,'forms'=>$output,'total'=>$total,'message'=>'Showing ' . $show . ' starting on ' . $start], 200);
        }
    }

    public function getLog() {
        helper('permissions');
        $request = service('request');

        if (!admin_Permission()) { return $this->failUnauthorized(); }

        $show = $request->getGet("show") == null ? 50 : $request->getGet("show");
        $start = $request->getGet("start") == null ? 0 : $request->getGet("start");

        $submissions = model('FormModel')->orderBy('created_at','DESC')->findAll();
        $evaluations = model('FormEvaluationModel')->orderBy('evaluated_at','DESC')->findAll();

        $typeNames = array_column(model('FormTypeModel')->findAll(),'name','id');

        $log = [];

        foreach ($submissions as $submission) {
            if ($submission['type'] == '1') {
                if (model('ParticipationFormModel')->find($submission['id'])->email_verified == 1) {
                    $log[] = [
                        'id'=>$submission['id'],
                        'type'=>$typeNames[$submission['type']],
                        'action'=>'submitted',
                        'datetime'=>$submission['created_at']
                    ];
                }
            } else {
                $log[] = [
                    'id'=>$submission['id'],
                    'type'=>$typeNames[$submission['type']],
                    'action'=>'submitted',
                    'datetime'=>$submission['created_at']
                ];
            }
        }

        foreach ($evaluations as $evaluation) {
            $log[] = [
                'id'=>$evaluation['form'],
                'type'=>$typeNames[model('FormModel')->find($evaluation['form'])['type']],
                'action'=>$evaluation['approved'] ? 'approved' : 'rejected',
                'datetime'=>$evaluation['evaluated_at']
            ];
        }

        if (array_multisort(array_column($log, 'datetime'), SORT_DESC, $log)) {
            $this->fail('Failed to sort data',500);
        }

        $log = array_slice($log, $start, $show);

        return $this->setResponseFormat('json')->respond(['ok'=>true,'log'=>$log,'message'=>'Showing ' . $show . ' starting on ' . $start], 200);
    }




}