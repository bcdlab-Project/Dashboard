<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLoggInsModel extends Model
{
    protected $table = 'UserLoggIns';
    protected $primaryKey = 'cookie';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\UserLoggInsModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cookie','user', 'useragent', 'expire'];

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