<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Projects extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->setResponseFormat('json')->respond(['nodes'=>true], 200);
    }

    public function getRegisterNode() {
        return $this->setResponseFormat('json')->respond(['registernodes'=>true], 200);
    }
}