<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Participate extends BaseController
{
    use ResponseTrait;

    private $validationRules = [
        'requested_username' => 'required|max_length[30]',
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
        $data['title'] = 'Participate';
        $data['pageMargin'] = false;
        $data['view'] = 'participate';

        return view('templates/header', $data)
            . view('participate')
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

            $result = model('ParticipationFormModel')->insert($data);
            if ($result) {
                return $this->setResponseFormat('json')->respond(['ok' => true], 200);

            } else {
                return $this->setResponseFormat('json')->respond(['ok' => false], 200);
            }
            
        }
    }

    public function getConfirmEmail() {
        $inputs = $this->request->getGet(['id','email','token']);


        $data['title'] = 'Confirm Email';
        $data['pageMargin'] = true;
        $data['view'] = 'confirmEmail';

        return view('templates/header', $data)
            .json_encode($inputs)
            // . view('confirmEmail')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}