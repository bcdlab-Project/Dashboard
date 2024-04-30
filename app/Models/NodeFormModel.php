<?php

namespace App\Models;

use CodeIgniter\Model;

class NodeForm extends Model
{
    protected $table = 'NodeForms';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\NodeForm::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','owner','alias','description'];

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