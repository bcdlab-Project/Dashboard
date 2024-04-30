<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Main extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->failForbidden();
    }

}