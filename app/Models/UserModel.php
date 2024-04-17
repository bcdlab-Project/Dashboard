<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType = \App\Entities\User::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'oauth_id', 'banned', 'deleted'];

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

    public function getByGithub($githubId) {
        $userGithubModel = model('UserGithubModel');
        $github = $userGithubModel->where('github_id', $githubId)->first();

        if ($github != null) {
            $user = $this->find($github['user']);
            return $user;
        } else {
            return false;
        }
    }

    public function getByCookie($userAgent) {
        $UserLoggInsModel = model('UserLoggInsModel');
        $userLoggIn = $UserLoggInsModel->where('cookie',get_cookie('loggedIn'))->first();
    
        if ($userLoggIn != null) {
            if ($userLoggIn['useragent'] == $userAgent && $userLoggIn['expire'] > date('Y-m-d H:i:s')) {
                $user = $this->find($userLoggIn['user']);
                return $user;
            } else {
                $UserLoggInsModel->where('cookie',get_cookie('loggedIn'))->delete();
                delete_cookie('loggedIn');
                return false;
            }
        } else {
            return false;
        }
    }

    public function getByEmail($email) {
        return $this->where('email', $email)->first();
    }
}