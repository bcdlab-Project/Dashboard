<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    public function checkPassword(string $pass)
    {
        return password_verify($pass, $this->attributes['password']);
    }
}