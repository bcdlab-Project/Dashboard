<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Participate extends BaseController
{
    use ResponseTrait;

    public function getIndex() {
        $data['title'] = 'Participate';
        $data['centerContent'] = true;
        $data['view'] = 'participate';

        return view('templates/header', $data)
            . view('participate')
            . view('templates/footer');
    }

    public function postValidate($part) {
        $rulesFirst = [
            'username' => 'required|max_length[30]',
            'email'    => 'required|max_length[254]|valid_email',
            'password' => 'required|max_length[255]|min_length[10]',
            'confpassword' => 'required|max_length[255]|matches[password]'
        ];

        $rulesSecond = [
            'username' => 'required|max_length[30]',
            'email'    => 'required|max_length[254]|valid_email',
            'password' => 'required|max_length[255]|min_length[10]',
            'confpassword' => 'required|max_length[255]|matches[password]',
            'whyParticipate' => 'required',
            'workRole' => 'max_length[25]',
            'githubProfile' => 'max_length[25]|valid_url_strict'
            
        ];

        $alias = [
            'username' => lang('Auth.username'),
            'email'    => lang('Auth.email'),
            'password' => lang('Auth.password'),
            'confpassword' => lang('Auth.passwordConfirm'),
            'whyParticipate' => lang('CustomTerms.whyParticipate'),
            'workRole' => lang('CustomTerms.workRole'),
            'githubProfile' => lang('CustomTerms.githubProfile')
        ];

        if ($part == 'first') {
            $data = $this->request->getPost(['username','email','password','confpassword']);
            $rules = $rulesFirst;
        } else {
            $data = $this->request->getPost(['username','email','password','confpassword','whyParticipate','workRole','githubProfile']);
            $rules = $rulesSecond;
        }

        if (! $this->validateData($data, $rules)) {
            $errors = $this->validator->getErrors();
            if ($part != 'first' && $data['githubProfile'] == '') {
                unset($errors['githubProfile']);
            }
            foreach ($errors as $key => $value) {
                $errors[$key] =  str_replace($key,$alias[$key],$value);
            }

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            return $this->setResponseFormat('json')->respond(['ok' => true], 200);
        }
    }
}