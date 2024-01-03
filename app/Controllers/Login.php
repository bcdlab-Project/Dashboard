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
        return Login::getIndex($error=true);
    }

}