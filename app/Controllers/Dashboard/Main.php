<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function getIndex() {
        helper('permissions');
        helper('roles');

        if (!loggedIn_Permission()) {
            return redirect()->to('/authentication/login');
        }

        $data['title'] = lang('Pages.dashboard');
        $data['pageMargin'] = true;
        $data['view'] = 'dashboard';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/header')
            . view('dashboard/' . getRoleInfo()['name_en'])
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}