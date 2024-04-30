<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); }

        $data['title'] = 'Dashboard';
        $data['pageMargin'] = true;
        $data['view'] = 'dashboard';

        return view('templates/header', $data)
            . view('dashboard/Administrator')
            . view('templates/footer');
    }

}