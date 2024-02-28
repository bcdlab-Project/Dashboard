<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectGithubModel extends Model
{
    protected $table = 'ProjectGithub';
    protected $primaryKey = 'projectId';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ProjectGithub::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['project', 'instance_id', 'repository_name','repository_full_name'];

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