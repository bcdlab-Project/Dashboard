<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Utilities extends BaseController
{
    use ResponseTrait;

    // public function getChangetheme() {
    //     $this->session->set('theme', (($this->session->get('theme') === 'dark') ? 'light' : 'dark'));
    //     return $this->setResponseFormat('json')->respond(['ok' => true, 'new_theme' => $this->session->get('theme')], 200);
    // }

    public function getChangelanguage() {
        $this->session->set('language', (($this->session->get('language') === 'en') ? 'pt' : 'en'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    // public function getTest() {
    //     $participationFormModel = new \App\Models\ParticipationFormModel();
    //     $participationForm = new \App\Entities\ParticipationForm();
    //     $participationForm->requested_username = 'nerexbcd';
    //     $participationForm->requested_password = password_hash('admin',PASSWORD_DEFAULT);
    //     $participationForm->requested_email = 'me@nerexbcd.xyz';
    //     $participationForm->why_participate = 'I want to participate';
    //     $participationForm->work_role = 'Developer';
    //     $participationForm->github_url = 'https://github.com/nerexbcd';

    //     echo $participationFormModel->insert($participationForm);
    //     unset($participationForm);

    //     $userModel = new \App\Models\UserModel();
    //     $user           = new \App\Entities\User();
    //     $user->username = 'nerexbcd';
    //     $user->role = '1';
    //     $user->email    = 'me@nerexbcd.xyz';
    //     $user->password = password_hash('admin',PASSWORD_DEFAULT);
    //     $user->participation_form = '2';

    //     echo $userModel->insert($user);
    //     unset($user);

    // }
}