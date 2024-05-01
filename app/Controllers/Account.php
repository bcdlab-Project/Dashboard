<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Account extends BaseController
{

    use ResponseTrait;

    public function getIndex() {
        helper('permissions');

        if (!loggedIn_Permission()) {
            return redirect()->to('/login'); //give error
        }
        
        $data['title'] = 'Account | bcdlab-Project';
        $data['pageMargin'] = true;
        $data['view'] = 'account';

        return view('templates/header', $data)
            . view('account')
            . view('templates/footer');       
    }    
}