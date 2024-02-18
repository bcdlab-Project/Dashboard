<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;

    public function getIndex($error = false) {
        if ($this->session->get('isLoggedIn')) { 
            return redirect()->to('/'); 
        }

        $data['title'] = 'Login';
        $data['centerContent'] = true;
        $data['error'] = $error;
        $data['view'] = 'login';
        // $data['scripts'] = ['views/login.js'];

        return view('templates/header', $data)
            . view('login')
            . view('templates/footer');
    }

    public function postIndex() {
        $userModel = model('UserModel');
        if (!(empty($this->request->getPost('username')) && empty($this->request->getPost('password')))) {
            $user = $userModel->where('username', $this->request->getPost('username'))->first();
            if (!$user == null) {
                if ($user->checkPassword($this->request->getPost('password'))) {
                    $user->login();
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
        . view('templates/footer');
    }

    public function getGithub() {
        if ($this->session->get('GitHubCheck') != $this->request->getGet('key')) { return redirect()->to('/login'); } //can also give error

        

        // echo json_encode($this->session->get('GitHubUserData')['id']);

        $userGithubModel = model('UserGithubModel');
        $userModel = model('UserModel');

        $github = $userGithubModel->where('github_id', $this->session->get('GitHubUserData')['id'])->first();

        $this->session->remove('GitHubCheck');
        $this->session->remove('GitHubUserData');
        $this->session->remove('GitHubToken');

        if ($github == null) { return Login::getIndex(true); }

        $user = $userModel->find($github->user);
        $user->login();  
    }
}