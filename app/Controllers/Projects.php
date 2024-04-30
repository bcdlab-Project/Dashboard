<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Projects extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); }
        
        $data['title'] = 'Projects';
        $data['pageMargin'] = true;
        $data['view'] = 'projects';

        return view('templates/header', $data)

            . view('dashboard/projects')
            . view('templates/footer') ;    
    }
}