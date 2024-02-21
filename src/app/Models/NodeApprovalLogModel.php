<?php

namespace App\Models;

use CodeIgniter\Model;

class NodeApprovalLogModel extends Model
{
    protected $table = 'node_approval_log';
    protected $primaryKey = 'nodeId';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\NodeApprovalLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nodeId', 'approvedAdmin'];

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