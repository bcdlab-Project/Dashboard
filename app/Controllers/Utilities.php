<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Utilities extends BaseController
{
    use ResponseTrait;

    public function getIndex()
    {
        return phpinfo();
    }

}