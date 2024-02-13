<?php

namespace App\Models;

use CodeIgniter\Model;

class NodeModel extends Model
{
    protected $table = 'Nodes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = \App\Entities\Node::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['owner', 'secret', 'tunnel_UUID','tunnel_Credentials','alias'];

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