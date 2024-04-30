<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Request extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); }
        
        $data['title'] = 'Make a Request';
        $data['pageMargin'] = false;
        $data['view'] = 'request';

        return view('templates/header', $data)
            . view('request/main')
            . view('templates/footer');
    }
}