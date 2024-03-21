<?php

namespace App\Controllers\Api\Content;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Main extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->setResponseFormat('json')->respond(['ok'=>false],400);
    }

}