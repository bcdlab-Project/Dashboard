<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountManagementLogModel extends Model
{
    protected $table = 'account_management_log';
    protected $primaryKey = 'timeStamp';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\AccountManagementLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['changeAuthor', 'managedUser', 'action'];

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