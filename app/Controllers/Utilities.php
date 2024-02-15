<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Utilities extends BaseController
{
    use ResponseTrait;

    public function getChangetheme() {
        $this->session->set('theme', (($this->session->get('theme') === 'dark') ? 'light' : 'dark'));
        return $this->setResponseFormat('json')->respond(['ok' => true, 'new_theme' => $this->session->get('theme')], 200);
    }

    public function getChangelanguage() {
        $this->session->set('language', (($this->session->get('language') === 'en') ? 'pt' : 'en'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function getTest() {
        
        // $userModel = new \App\Models\UserModel();
        // $user           = new \App\Entities\User();
        // $user->username = 'apascoa';
        // $user->participation_form_id = '1';
        // $user->email    = 'foo@example.com';
        // $user->role = 'Administrator';
        // $user->password = password_hash('abc456',PASSWORD_DEFAULT);
        // echo $userModel->save($user);
        // unset($user);
    }
}