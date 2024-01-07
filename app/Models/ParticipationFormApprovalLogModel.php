<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipationFormApprovalLogModel extends Model
{
    protected $table = 'participation_from_approval_log';
    protected $primaryKey = 'participationFormId';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ParticipationFormApprovalLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['participationFormId', 'approvedAdmin','username'];

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