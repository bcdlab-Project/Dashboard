<?php

namespace App\Models;

use CodeIgniter\Model;

class NodeExecutionLogModel extends Model
{
    protected $table = 'node_execution_log';
    protected $primaryKey = 'timeStamp';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\NodeExecutionLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['executionAuthor', 'nodeId', 'currentlyRunning'];

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