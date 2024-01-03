<?php

namespace App\Controllers;

class Utilities extends BaseController
{
    public function getChangetheme() {
        $session = \Config\Services::session();
        $session->set('theme', (($session->get('theme') === 'dark') ? 'light' : 'dark'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}