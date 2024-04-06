<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipationApprovalModel extends Model
{
    protected $table = 'ParticipationApproval';
    protected $primaryKey = 'participation_form';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ParticipationApproval::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['participation_form', 'approved_by','new_user'];

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