<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Projects extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!admin_Permission()) {
            return redirect()->to('/authentication/login');
        }
        
        $data['title'] = 'Projects';
        $data['pageMargin'] = true;
        $data['view'] = 'projects';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/header')
            . view('dashboard/projects')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}