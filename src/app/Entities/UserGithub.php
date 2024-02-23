<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserGithub extends Entity
{
    public function login() {
        $userModel = model('UserModel');

        $user = $userModel->find($this->attributes['user']);
        
        $session = session();
        $userData = [
            'id' => $user->attributes['id'],
            'username' => $user->attributes['username'],
            'role' => $user->attributes['role'],
            'email' => $user->attributes['email']
        ];
        $session->set('user_data',$userData);
        $session->set('isLoggedIn', true);
    }
    
}