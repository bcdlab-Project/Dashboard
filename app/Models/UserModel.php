<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey = 'username';
    protected $allowedFields = [
        'username', 'participation_form_id', 'email', 'role', 'password',
    ];
    protected $returnType    = \App\Entities\User::class;
    protected $useTimestamps = false;
}