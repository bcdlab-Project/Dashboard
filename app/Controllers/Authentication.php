<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Authentication extends BaseController
{
    use ResponseTrait;

    public function getLogin($error = false) {
        $session = \Config\Services::session();
        helper('cookie');

        if ($session->get('loggedIn')) { 
            return redirect()->to('/'); 
        }

        $data['title'] = 'Login';
        $data['pageMargin'] = false;
        $data['error'] = $error;
        $data['view'] = 'login';

        return view('templates/header', $data)
            . view('authentication/login')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

    public function postLogin() {
        $agent = $this->request->getUserAgent();
        $userModel = model('UserModel');
        if (!(empty($this->request->getPost('username')) && empty($this->request->getPost('password')))) {
            $user = $userModel->where('username', $this->request->getPost('username'))->first();
            if (!$user == null) {
                if ($user->checkPassword($this->request->getPost('password'))) {
                    $user->processLogin($this->request->getPost('remember')?true:false, $agent->getAgentString());
                    unset($user);
                    return $this->setResponseFormat('json')->respond(['ok' => true],200);
                }
            }
        }
        unset($user);
        return $this->setResponseFormat('json')->respond(['ok' => false],401);
    }

    public function getForgotpassword() {
        $data['title'] = 'Password Recovery';
        $data['pageMargin'] = false;
        $data['view'] = 'forgotpassword';
        $data['scripts'] = ['forms.js'];

        return view('templates/header', $data)
        . view('authentication/forgotpassword')
        . view('templates/footer') 
        . view('templates/sidemenu');
    }

    public function postForgotpassword() {
        $data['email'] = $this->request->getPost('email');

        if (! $this->validateData($data, ['email' => 'max_length[254]|valid_email'])) {
            $errors = $this->validator->getErrors();
            $errors['email'] = str_replace('email','Email',$errors['email']);
            $errors['ok'] = false;

            return $this->setResponseFormat('json')->respond($errors, 200);
        }
        $userModel = model('UserModel');
        $user = $userModel->getByEmail($data['email']);
        if ($user != null) {
            $user->sendPasswordRecovery();
        }
        return $this->setResponseFormat('json')->respond(['ok' => true],200);
    }

    public function getRecoverPassword() {
        $data['title'] = 'Recover Password';
        $data['pageMargin'] = false;
        $data['view'] = 'recoverpassword';
        $data['scripts'] = ['forms.js'];

        $userModel = model('UserModel');
        $user = $userModel->find($this->request->getGet('id'));
        if ($user != null) {
            if ($user->validatePasswordRecovery($this->request->getGet('token'))) {
                return view('templates/header', $data)
                . view('authentication/recoverpassword')
                . view('templates/footer') 
                . view('templates/sidemenu');
            }
        }
        return redirect()->to('/authentication/forgotpassword');
    }

    public function postRecoverPassword() {
        $data = $this->request->getPost(['token','id','password','confpassword']);
        $rules = [        
            'password' => 'required|max_length[255]|min_length[10]',
            'confpassword' => 'required|max_length[255]|matches[password]',
        ];
        $paramAlias = [
            'password' => 'Password',
            'confpassword' => 'Confirmation Password',
        ];


        $userModel = model('UserModel');
        $user = $userModel->find($data['id']);
        if ($user != null) {
            if (!$this->validateData($data, $rules)){
                $errors = $this->validator->getErrors();
                foreach ($errors as $key => $value) {
                    $errors[$key] =  str_replace($key,$paramAlias[$key],$value);
                }
                $errors['ok'] = false;
                $errors['hasErrors'] = true;
                return $this->setResponseFormat('json')->respond($errors, 200);
            }
            if ($user->recoverPassword($data['token'], $data['password'])) {
                return $this->setResponseFormat('json')->respond(['ok' => true],200);
            }
            return $this->setResponseFormat('json')->respond(['ok' => false],200);
        }
        return $this->setResponseFormat('json')->respond(['ok' => false],401);
    }

    public function getGithub() {
        if ($this->session->get('GitHubCheck') != $this->request->getGet('key')) { return redirect()->to('/authentication/login'); } //can also give error

        $userModel = model('UserModel');
        $user = $userModel->getByGithub($this->session->get('GitHubUserId'));

        $tempToken = $this->session->get('GitHubToken');

        $this->session->remove('GitHubUserId');
        $this->session->remove('GitHubToken');

        if ($user) { 
            $user->login();
            $user->setGithubToken($tempToken);
            return redirect()->to('/dashboard');
        } else { return Authentication::getLogin(true); } //Can give error
    }

    public function getLogout() {
        if ($this->session->get('loggedIn')) {
            $user = model('UserModel')->find($this->session->get('user_data')['id']);
            $user->logout();
            return $this->setResponseFormat('json')->respond(['ok' => true],200);
        }
        return $this->setResponseFormat('json')->respond(['ok' => false],401);
    }
}