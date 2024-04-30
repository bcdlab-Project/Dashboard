<?php

namespace App\Models;

use CodeIgniter\Model;

class FormEvaluationModel extends Model
{
    protected $table = 'FormEvaluations';
    protected $primaryKey = 'form';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\ParticipationForm::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['approved','evaluated_by'];

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