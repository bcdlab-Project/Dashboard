<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Nodes extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!(admin_Permission() || collaborator_Permission())) { return redirect()->to('/'); }
        
        $data['title'] = 'Nodes';
        $data['pageMargin'] = true;
        $data['view'] = 'nodes/main';
        $data['scripts'] = [];

        return view('templates/header', $data)
            . view('nodes/main')
            . view('templates/footer');
    }

    public function getDetails($nodeId) {
        helper('permissions');
        if (!(admin_Permission() || collaborator_Permission())) { return redirect()->to('/'); }
        if (model('NodeModel')->find($nodeId) == null) { return redirect()->to('/nodes'); } // give error

        $data['title'] = 'Node ' . $nodeId;
        $data['pageMargin'] = true;
        $data['view'] = 'nodes/details';

        return view('templates/header', $data)
            . view('nodes/details')
            . view('templates/footer');
    }
}