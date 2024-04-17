<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDiscordModel extends Model
{
    protected $table = 'UserDiscord';
    protected $primaryKey = 'user';

    protected $useAutoIncrement = false;

    // protected $returnType = \App\Entities\UserDiscord::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user', 'discord_username', 'discord_id'];

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