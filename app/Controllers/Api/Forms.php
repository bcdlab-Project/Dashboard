<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Forms extends Controller
{
    use ResponseTrait;
    
    public function getIndex($id = false,$action = false) {
        helper('permissions');
        if (!admin_Permission()) { return $this->failUnauthorized(); }


        if (!$id && !$action) {
            $nodes = model('NodeModel')->findAll();

    
            if ($nodes) {
                foreach ($nodes as $node) {
                    $details = $node->getDetails();
                    unset($node->secret);
                    unset($node->tunnel_Credentials);
                    $node->owner = $details->owner;
                    $node->status = $node->getstatus();
                    $node->owner_name = model('UserModel')->where('id', $details->owner)->first()->keycloakData()['username'];
                    $node->alias = $details->alias;
                    $node->description = $details->description;
                }
            }
    
            return $this->setResponseFormat('json')->respond(['ok'=>true,'nodes'=>$nodes], 200);
        }

        if ($id && !$action) {
            $node = model('NodeModel')->find($id);
            if (!$node) {
                return $this->fail('Not Found',404);
            }
            $details = $node->getDetails();
            $data['id'] = $node->id;
            $data['tunnel_UUID'] = $node->tunnel_UUID;
            $data['last_updated'] = $node->last_updated;
            $data['owner'] = $details->owner;
            $data['status'] = $node->getstatus();
            $data['owner_name'] = model('UserModel')->where('id', $details->owner)->first()->keycloakData()['username'];
            $data['alias'] = $details->alias;
            $data['description'] = $details->description;
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }

    }

    public function getParticipation($id = false, $action = false) {
        helper('permissions');
        $request = \Config\Services::request();

        if (!admin_Permission()) { return $this->failUnauthorized(); }

        $count = $request->getGet("count") == null ? 50 : $request->getGet("count");
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
            $submissions = $query->findAll($count,$start);

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

            return $this->setResponseFormat('json')->respond(['ok'=>true,'forms'=>$output,'total'=>$total,'message'=>'Showing ' . $count . ' starting on ' . $start], 200);
        }
    }

    public function getLog() {
        helper('permissions');
        if (!admin_Permission()) { return $this->failUnauthorized(); }

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

        array_splice($log, 50);

        return $this->setResponseFormat('json')->respond(['ok'=>true,'log'=>$log,'message'=>'Showing Only 50 first'], 200);
    }




}