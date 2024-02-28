<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoles extends Model
{
    protected $table = 'UserRoles';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = \App\Entities\UserRoles::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

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