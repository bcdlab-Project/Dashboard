<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;

class Utilities extends BaseController
{
    public function getChangetheme() {
        $this->session->set('theme', (($this->session->get('theme') === 'dark') ? 'light' : 'dark'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function getChangelanguage() {
        $this->session->set('language', (($this->session->get('language') === 'en') ? 'pt' : 'en'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function getTest() {
        

        // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'foo-bar',
            'participation_form_id' => '1',
            'email'    => 'admin@test.pt',
            'role'    => 'Developer',
            'password' => 'secret plain text password',
        ]);
        $users->save($user);
    }
}