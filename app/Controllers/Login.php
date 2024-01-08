<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function getIndex($error=false) {
        $data['title'] = 'Login';
        $data['centerContent'] = true;
        $data['error'] = $error;

        return view('templates/header', $data)
            . view('login')
            . view('templates/footer');
    }

    public function postIndex() {
        $userModel = new \App\Models\UserModel();
        if (!(empty($this->request->getPost('username')) && empty($this->request->getPost('password')))) {
            $user = $userModel->find($this->request->getPost('username'));
            if (!$user == null) {
                if ($user->checkPassword($this->request->getPost('password'))) {
                    unset($user);
                    return redirect()->to('/');
                }
            }
        }
        unset($user);
        return Login::getIndex(true);
    }

    public function getForgotpassword() {
        $data['title'] = 'Password Recovery';
        $data['centerContent'] = true;
        $data['error'] = false;

        return view('templates/header', $data)
        . view('templates/footer');
    }
}