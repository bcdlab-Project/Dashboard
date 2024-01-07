<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectGithubIntegrationModel extends Model
{
    protected $table = 'project_github_integration';
    protected $primaryKey = 'projectId';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ProjectGithubIntegration::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['projectId', 'instanceId', 'repositoryName','repositoryFullName'];

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