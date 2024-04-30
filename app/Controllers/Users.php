<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Users';
        $data['pageMargin'] = true;
        $data['view'] = 'users';

        return view('templates/header', $data)
            . view('dashboard/users')
            . view('templates/footer');  
    }
}