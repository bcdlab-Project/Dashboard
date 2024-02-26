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
        $data['centerContent'] = true;
        $data['error'] = $error;
        $data['view'] = 'login';

        return view('templates/header', $data)
            . view('login')
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
        $data['centerContent'] = true;
        $data['error'] = false;

        return view('templates/header', $data)
        . view('templates/footer') 
        . view('templates/sidemenu');
    }

    public function getGithub() {
        if ($this->session->get('GitHubCheck') != $this->request->getGet('key')) { return redirect()->to('/authentication/login'); } //can also give error

        $userModel = model('UserModel');
        $user = $userModel->getByGithub($this->session->get('GitHubUserData')['id']);
        if ($user) { 
            $user->login();
        } else { return Authentication::getLogin(true); } //Can give error
        
        $this->session->remove('GitHubCheck');
        $this->session->remove('GitHubUserData');
        $this->session->remove('GitHubToken');
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