<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    public function checkPassword(string $pass)
    {
        return password_verify($pass, $this->attributes['password']);
    }

    public function login()
    {
        $session = session();
        $userData = [
            'id' => $this->attributes['id'],
            'username' => $this->attributes['username'],
            'role' => $this->attributes['role'],
            'email' => $this->attributes['email']
        ];
        $session->set('user_data',$userData);
        $session->set('isLoggedIn', true);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
    }
}