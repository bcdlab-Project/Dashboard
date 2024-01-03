<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function index() {
        $data['title'] = 'bcdlab-Project';

        return view('templates/header', $data)
            . view('main')
            . view('templates/footer');
    }

    public function changetheme() {
        $session = \Config\Services::session();
        $session->set('theme', (($session->get('theme') === 'dark') ? 'light' : 'dark'));
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}