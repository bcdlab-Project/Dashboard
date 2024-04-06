<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Nodes extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->setResponseFormat('json')->respond(['nodes'=>true], 200);
    }

    public function getRegisterNode() {
        return $this->setResponseFormat('json')->respond(['registernodes'=>true], 200);
    }

    public function postAuth() {
        $request = service('request');
        $data = $request->getPost(['connectionId','nodeId','token']);

        if (!$data['connectionId'] || !$data['nodeId'] || !$data['token']) {
            return $this->setResponseFormat('json')->respond(['ok'=>false], 400);
        }

        $NodeModel = model('NodeModel');
        $node = $NodeModel->find($data['nodeId']);

        if ($node != null) {
            if (true) { // $node->authenticate($data['token'])
                return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
            }
        }

        return $this->setResponseFormat('json')->respond(['ok'=>false], 401);
    }
}