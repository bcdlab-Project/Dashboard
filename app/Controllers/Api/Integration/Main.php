<?php

namespace App\Controllers\Api\Integration;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Main extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->failForbidden();
    }
}