<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Logout extends BaseController
{
    use ResponseTrait;

    public function getIndex() {
        if ($this->session->get('loggedIn')) {
            $this->session->remove('user_data');
            $this->session->remove('loggedIn');
            return redirect()->to('https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/logout');
        }
        return redirect()->to('/'); // send error
    }

    public function getAuto() {
        if ($this->session->get('loggedIn')) {
            $this->session->remove('user_data');
            $this->session->remove('loggedIn');
            return $this->setResponseFormat('json')->respond(['ok' => true],200);
        }
        return $this->setResponseFormat('json')->respond(['ok' => false],401);
    }
}