<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Nodes extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!admin_Permission()) {
            return redirect()->to('/login');
        }
        
        $data['title'] = 'Nodes';
        $data['pageMargin'] = true;
        $data['view'] = 'nodes';
        $data['hasNotification'] = true;
        $data['scripts'] = [];

        return view('templates/header', $data)
            . view('templates/notificationMenu')

            . view('dashboard/nodes')
            . view('templates/footer');
            
    }

}