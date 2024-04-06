<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Node extends Entity
{

    public function authenticate(string $code) {
        helper('otp');
        
        return boolval(generateOTP($this->secret) == $code);
    }
    
}