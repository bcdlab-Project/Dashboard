<?php

namespace App\Models;

use CodeIgniter\Model;

class UserGithubIntegrationModel extends Model
{
    protected $table = 'user_github_integration';
    protected $primaryKey = 'username';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\UserGithubIntegration::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'githubUsername', 'githubId','lastUsedLogin','accessToken','accTkExpire','refreshToken','refTkExpire'];

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