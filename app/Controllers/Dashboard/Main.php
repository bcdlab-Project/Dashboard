<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!loggedIn_Permission()) {
            return redirect()->to('/authentication/login');
        }

        $UserRolesModel = model('UserRolesModel');
        $role = $UserRolesModel->where('id', session()->get('user_data')['role'])->first()['name'];

        $data['title'] = $role . ' Dashboard';
        $data['pageMargin'] = true;
        $data['view'] = 'Dashboard';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/' . $role)
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}