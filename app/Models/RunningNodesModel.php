<?php

namespace App\Models;

use CodeIgniter\Model;

class RunningNodesModel extends Model
{
    protected $table = 'RunningNodes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\Node::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'connection_id', 'connected'];

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