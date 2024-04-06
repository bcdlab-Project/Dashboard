<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Participate extends BaseController
{
    use ResponseTrait;

    private $validationRules = [
        'requested_username' => 'required|max_length[25]',
        'requested_email'    => 'required|max_length[254]|valid_email',
        'requested_password' => 'required|max_length[255]|min_length[10]',
        'confpassword' => 'required|max_length[255]|matches[requested_password]',
        'why_participate' => 'required',
        'work_role' => 'max_length[25]',
        'github_profile' => 'max_length[25]|valid_url_strict'
    ];

    private $paramAlias = [
        'requested_username' => 'Username',
        'requested_email'    => 'Email',
        'requested_password' => 'Password',
        'confpassword' => 'Confirmation Password',
        'why_participate' => 'Why participate field',
        'work_role' => 'Work Role',
        'github_profile' => 'GitHub Profile field'
    ];

    public function getIndex() {
        helper('permissions');
        if (loggedIn_Permission()) {
            return redirect()->to(site_url('dashboard'));
        }

        $data['title'] = 'Participate';
        $data['pageMargin'] = false;
        $data['view'] = 'participate';
        $data['scripts'] = ['forms.js'];

        return view('templates/header', $data)
            . view('participate/main')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

    public function postValidate($part) {
        $rulesFirst = array_intersect_key($this->validationRules, array_flip(['requested_username','requested_email','requested_password','confpassword']));

        if ($part == 'first') {
            $data = $this->request->getPost(['requested_username','requested_email','requested_password','confpassword']);
            $rules = $rulesFirst; // uses only the first 4 rules
        } else {
            $data = $this->request->getPost(['requested_username','requested_email','requested_password','confpassword','why_participate','work_role','github_profile']);
            $rules = $this->validationRules; // uses the page rules
        }

        if (empty($data['github_profile'])) { $data['github_profile'] = null; unset($rules['github_profile']);}
        if (empty($data['work_role'])) { $data['work_role'] = null; }

        if (! $this->validateData($data, $rules)) {
            $errors = $this->validator->getErrors();
            foreach ($errors as $key => $value) {
                $errors[$key] =  str_replace($key,$this->paramAlias[$key],$value);
            }

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            return $this->setResponseFormat('json')->respond(['ok' => true], 200);
        }
    }

    public function postIndex() {
        helper('permissions');
        if (loggedIn_Permission()) {
            return $this->setResponseFormat('json')->respond(['ok' => false], 401);
        }

        $data = $this->request->getPost(['requested_username','requested_email','requested_password','confpassword','why_participate','work_role','github_profile']);
        $rules = $this->validationRules;

        if (empty($data['github_profile'])) { $data['github_profile'] = null; unset($rules['github_profile']);}
        if (empty($data['work_role'])) { $data['work_role'] = null; }

        if (! $this->validateData($data, $rules)) {
            $errors = $this->validator->getErrors();
            foreach ($errors as $key => $value) {
                $errors[$key] =  str_replace($key,$this->paramAlias[$key],$value);
            }

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            $data["requested_password"] = password_hash($data['requested_password'], PASSWORD_DEFAULT);


            $data['id'] = model('FormModel')->insert(['type' => 1],true);

            echo $data['id'];

            $result = model('ParticipationFormModel')->insert($data);
            if ($result) {
                model('ParticipationFormModel')->find($result)->initializeEmailConfirmation();
                return $this->setResponseFormat('json')->respond(['ok' => true], 200);
            } else {
                return $this->setResponseFormat('json')->respond(['ok' => false], 200);
            }
            
        }
    }

    public function getConfirmEmail() {
        $inputs = $this->request->getGet(['id','token']);
        
        $data['title'] = 'Confirm Email';
        $data['pageMargin'] = false;
        $data['view'] = 'confirmEmail';

        $data['messageok'] = false;

        if (!isset($inputs['id']) || !isset($inputs['token'])) {
            $data['message'] = 'Something went wrong. Please try again later.';
        } else {
            $model = model('ParticipationFormModel');
            $form = $model->find($inputs['id']);
    
            if ($form == null) {
                $data['message'] = 'Something went wrong. Please try again later.';
            } else if ($form->hasEmailConfirmed()) {
                $data['messageok'] = true;
                $data['message'] = 'Email already confirmed';
            } else if ($form->hasExpiredEmailConfirmation()) {
                $data['message'] = 'Email confirmation has expired. Please try to make a new Participation Request.';
            } else if ($form->confirmEmail($inputs['token'])) {
                $data['messageok'] = true;
                $data['message'] = 'Email confirmed successfully';
            } else {
                $data['message'] = 'Something went wrong. Please try again later.';
            }
        }

        return view('templates/header', $data)
            . view('participate/confirmEmail')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }
}