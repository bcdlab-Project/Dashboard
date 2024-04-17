<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!admin_Permission()) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Users';
        $data['pageMargin'] = true;
        $data['view'] = 'users';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')

            . view('dashboard/users')
            . view('templates/footer');
            
    }

}