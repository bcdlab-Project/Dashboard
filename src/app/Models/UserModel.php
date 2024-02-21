<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = \App\Entities\User::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'role', 'email', 'password', 'participation_form', 'banned', 'silenced', 'deleted'];

    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}