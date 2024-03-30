<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Nodes extends BaseController
{
    public function getIndex() {
        $data['title'] = 'Nodes';
        $data['pageMargin'] = true;
        $data['view'] = 'nodes';
        $data['hasNotification'] = true;
        $data['scripts'] = [];

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/header')
            . view('dashboard/nodes')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}