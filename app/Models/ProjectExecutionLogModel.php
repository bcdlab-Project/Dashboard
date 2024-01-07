<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectExecutionLogModel extends Model
{
    protected $table = 'project_execution_log';
    protected $primaryKey = 'timeStamp';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ProjectExecutionLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['executionAuthor', 'projectId', 'content'];

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