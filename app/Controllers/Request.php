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
        $data['view'] = 'request/main';

        return view('templates/header', $data)
            . view('request/main')
            . view('templates/footer');
    }

    public function getCollaboration() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); }
        
        $data['title'] = 'Collaboration Request';
        $data['pageMargin'] = false;
        $data['view'] = 'request/collaboration';

        return view('templates/header', $data)
            . view('request/collaboration')
            . view('templates/footer');
    }

    public function getProject() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); }
        
        $data['title'] = 'Project Request';
        $data['pageMargin'] = false;
        $data['view'] = 'request/project';

        return view('templates/header', $data)
            . view('request/project')
            . view('templates/footer');
    }
}