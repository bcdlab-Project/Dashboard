<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Forms extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Forms Evaluations';
        $data['pageMargin'] = true;
        $data['view'] = 'forms/overview';

        return view('templates/header', $data)
            . view('forms/header')
            . view('forms/overview')
            . view('templates/footer');
    }

    public function getParticipation($id = false) {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        if (!$id) {
            $data['title'] = 'Participation Forms';
            $data['pageMargin'] = true;
            $data['view'] = 'forms/participation/main';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/participation/main')
                . view('templates/footer');
        } else {
            if (model('FormModel')->where('type', 1)->find($id) == null) {return $this->fail('Form not found');}
        
            $data['title'] = 'Form Detais | ' . $id;
            $data['pageMargin'] = true;
            $data['view'] = 'forms/participation/details';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/participation/details')
                . view('templates/footer');
        }


    }

    public function getProject($id = false) {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        if (!$id) {
            $data['title'] = 'Projects Forms';
            $data['pageMargin'] = true;
            $data['view'] = 'forms/project/main';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/project/main')
                . view('templates/footer');
        } else {
            if (model('FormModel')->where('type', 2)->find($id) == null) {return $this->fail('Form not found');}
            $data['title'] = 'Form Detais | ' . $id;
            $data['pageMargin'] = true;
            $data['view'] = 'forms/project/details';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/project/details')
                . view('templates/footer');
        }
    }

    public function getCollaboration($id = false) {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        if (!$id) {
            $data['title'] = 'Collaboration Forms';
            $data['pageMargin'] = true;
            $data['view'] = 'forms/collaboration/main';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/collaboration/main')
                . view('templates/footer');
        } else {
            if (model('FormModel')->where('type', 3)->find($id) == null) {return $this->fail('Form not found');}
            $data['title'] = 'Form Detais | ' . $id;
            $data['pageMargin'] = true;
            $data['view'] = 'forms/collaboration/details';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/collaboration/details')
                . view('templates/footer');
        }
    }

    public function getOther($id = false) {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        if (!$id) {
            $data['title'] = 'Other Forms';
            $data['pageMargin'] = true;
            $data['view'] = 'forms/other/main';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/other/main')
                . view('templates/footer');
        } else {
            if (model('FormModel')->where('type', 4)->find($id) == null) {return $this->fail('Form not found');}
            $data['title'] = 'Form Detais | ' . $id;
            $data['pageMargin'] = true;
            $data['view'] = 'forms/other/details';
    
            return view('templates/header', $data)
                . view('forms/header')
                . view('forms/other/details')
                . view('templates/footer');
        }
    }

    private function fail($message) {
        $data['message'] = $message;
        return view('errors/html/error_404', $data);
    }
}