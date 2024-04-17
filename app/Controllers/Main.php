<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function getIndex() {
        helper('permissions');
        helper('roles');

        if (!loggedIn_Permission()) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Dashboard';
        $data['pageMargin'] = true;
        $data['view'] = 'dashboard';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/Administrator')
            . view('templates/footer');
    }

}