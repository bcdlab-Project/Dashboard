<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectApprovalLogModel extends Model
{
    protected $table = 'project_approval_log';
    protected $primaryKey = 'projectId';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ProjectApprovalLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['projectId', 'approvedAdmin'];

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