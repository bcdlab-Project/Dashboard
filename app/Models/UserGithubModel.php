<?php

namespace App\Models;

use CodeIgniter\Model;

class UserGithubModel extends Model
{
    protected $table = 'UserGithub';
    protected $primaryKey = 'user';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\UserGithub::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user', 'github_username', 'github_id','last_loggedin','access_token','acc_tk_expire','refresh_token','ref_tk_expire'];

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