<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Account extends BaseController
{

    use ResponseTrait;

    public function getIndex() {
        helper('permissions');

        if (!loggedIn_Permission()) {
            return redirect()->to('/login'); //give error
        }
        
        $data['title'] = 'Account | bcdlab-Project';
        $data['pageMargin'] = true;
        $data['hasNotification'] = true;
        $data['view'] = 'account';
        $data['scripts'] = ['forms.js'];

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('account')
            . view('templates/footer');       
    }

    public function postUpdateUsername() {
        helper('permissions');
        $session = session();

        if (!loggedIn_Permission() || !own_Permission($session->get('user_data')['id'])) {
            return redirect()->to('/login'); //give error
        }

        $username = $this->request->getPost('username');

        if (!$this->validateData(['username' => $username], ['username' => 'required|max_length[25]'])) {
            $errors = $this->validator->getErrors();

            $errors['username'] =  str_replace('username','Username',$errors['username']);

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            $userModel = model('UserModel');
            $userModel->update($session->get('user_data')['id'], ['username' => $username]);
            $userModel->find($session->get('user_data')['id'])->loadUserLoggin();

            return $this->setResponseFormat('json')->respond(['ok' => true], 200);
        }
    }

    public function postUpdateEmail() {
        helper('permissions');
        $session = session();

        if (!loggedIn_Permission() || !own_Permission($session->get('user_data')['id'])) {
            return redirect()->to('/login'); //give error
        }

        $email = $this->request->getPost('email');

        if (!$this->validateData(['email' => $email], ['email' => 'required|max_length[254]|valid_email'])) {
            $errors = $this->validator->getErrors();

            $errors['email'] =  str_replace('email','Email',$errors['email']);

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            $userModel = model('UserModel');
            $userModel->update($session->get('user_data')['id'], ['email' => $email]);
            $userModel->find($session->get('user_data')['id'])->loadUserLoggin();

            return $this->setResponseFormat('json')->respond(['ok' => true], 200);
        }
    }

    public function postUpdatePassword() {
        helper('permissions');
        $session = session();

        if (!loggedIn_Permission() || !own_Permission($session->get('user_data')['id'])) {
            return redirect()->to('/login'); //give error
        }

        $data = $this->request->getPost(['password','confpassword']);

        if (!$this->validateData($data, ['password' => 'required|max_length[255]|min_length[10]','confpassword' => 'required|max_length[255]|matches[password]',])) {
            $errors = $this->validator->getErrors();


            if (isset($errors['password'])) {
                $errors['password'] =  str_replace('password','Password',$errors['password']);
            }
            if (isset($errors['confpassword'])) {
                $errors['confpassword'] =  str_replace('password','Password',str_replace('confpassword','Confirmation Password',$errors['confpassword']));
            }

            return $this->setResponseFormat('json')->respond($errors, 200);
        } else {
            $userModel = model('UserModel');
            $userModel->update($session->get('user_data')['id'], ['password' => password_hash($data['password'], PASSWORD_DEFAULT)]);
            $userModel->find($session->get('user_data')['id'])->loadUserLoggin();

            return $this->setResponseFormat('json')->respond(['ok' => true], 200);
        }
    }

    
}