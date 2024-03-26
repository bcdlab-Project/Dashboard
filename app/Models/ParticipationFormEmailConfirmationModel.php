<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipationFormEmailConfirmationModel extends Model
{
    protected $table = 'ParticipationFormEmailConfirmation';
    protected $primaryKey = 'participation_form';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\Node::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['participation_form', 'token'];

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