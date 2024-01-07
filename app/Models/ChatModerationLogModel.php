<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModerationLogModel extends Model
{
    protected $table = 'chat_moderation_log';
    protected $primaryKey = 'timeStamp';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\ChatModerationLog::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['changeAuthor', 'messageId', 'action'];

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