<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!admin_Permission()) {
            return redirect()->to('/authentication/login');
        }

        $data['title'] = 'Users';
        $data['pageMargin'] = true;
        $data['view'] = 'users';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/header')
            . view('dashboard/users')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}