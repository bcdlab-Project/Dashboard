<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsApprovalModel extends Model
{
    protected $table = 'ProjectsApprovals';
    protected $primaryKey = 'project';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ProjectApproval::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['project', 'approved_by'];

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