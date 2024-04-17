<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPasswordRecoveryModel extends Model
{
    protected $table = 'UserPasswordRecovery';
    protected $primaryKey = 'user';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\Project::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user', 'token'];

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