<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    public function checkPassword(string $pass)
    {
        return password_verify($pass, $this->attributes['password']);
    }

    public function processLogin(bool $rememberMe, string $userAgent)
    {
        helper('cookie');

        if ($rememberMe) {
            helper('text');
            $loggedSession = random_string('alnum',24);
            set_cookie('loggedIn', $loggedSession, path: '/', httpOnly: true, expire: 3600*24*7);
            $UserLoggInsModel = model('UserLoggInsModel');
            $UserLoggInsModel->insert(['cookie' => $loggedSession,'user' => $this->attributes['id'], 'useragent' => $userAgent, 'expire' => date('Y-m-d H:i:s', strtotime('+7 days'))]);
        } else {
            set_cookie('loggedIn', 'session', path: '/', httpOnly: true);
        }

        self::loadUserLoggin();
    }

    public function logout() {
        helper('cookie');
        
        $UserLoggInsModel = model('UserLoggInsModel');
        $UserLoggInsModel->where('cookie',get_cookie('loggedIn'))->delete();

        delete_cookie('loggedIn');

        $session = session();
        $session->remove('user_data');
        $session->remove('loggedIn');

    }
    
    public function login() {
        self::loadUserLoggin();
    }


    private function loadUserLoggin() {
        $session = session();
        $userData = [
            'id' => $this->attributes['id'],
            'username' => $this->attributes['username'],
            'role' => $this->attributes['role'],
            'email' => $this->attributes['email']
        ];
        $session->set('loggedIn',true);
        $session->set('user_data',$userData);
        // $session->get('user_data')['username']
    }

    public function getGithub() {
        $UserGithubModel = model('UserGithubModel');
        $data = $UserGithubModel->where('user',$this->attributes['id'])->first();

        if ($data) {
            return [
                'id' => $data['github_id'],
                'username' => $data['github_username'],
                'last_loggedin' => $data['last_loggedin'],
                'created_at' => $data['created_at'],
            ];
        }
        return false;
    }

    public function getDiscord() {
        $UserDiscordModel = model('UserDiscordModel');
        $data = $UserDiscordModel->where('user',$this->attributes['id'])->first();

        if ($data) {
            return [
                'id' => $data['discord_id'],
                'username' => $data['discord_username'],
                'created_at' => $data['created_at'],
            ];
        }
        return false;
    }

    public function setGithub(array $data, array $token) {
        $UserGithubModel = model('UserGithubModel');
        $UserGithubModel->insert(['user' => $this->attributes['id'], 'github_id' => $data['id'], 'github_username' => $data['login'], 'access_token' => $token['access_token'], 'refresh_token' => $token['refresh_token'], 'acc_tk_expire' => date('Y-m-d H:i:s', strtotime('+'.$token['expires_in'].' seconds')), 'ref_tk_expire' => date('Y-m-d H:i:s', strtotime('+'.$token['refresh_token_expires_in'].' seconds'))]);
    }

    public function unsetGithub() {
        $UserGithubModel = model('UserGithubModel');
        $UserGithubModel->delete($this->attributes['id']);
    }

    public function setGithubToken(array $token) {
        $UserGithubModel = model('UserGithubModel');
        $UserGithubModel->update($this->attributes['id'],['access_token' => $token['access_token'], 'refresh_token' => $token['refresh_token'], 'acc_tk_expire' => date('Y-m-d H:i:s', strtotime('+'.$token['expires_in'].' seconds')), 'ref_tk_expire' => date('Y-m-d H:i:s', strtotime('+'.$token['refresh_token_expires_in'].' seconds')), 'last_loggedin' => date('Y-m-d H:i:s')]);
    }

    public function setDiscord(array $data) {
        $UserDiscordModel = model('UserDiscordModel');
        $UserDiscordModel->insert(['user' => $this->attributes['id'], 'discord_id' => $data['id'], 'discord_username' => $data['username']]);
    }

    public function unsetDiscord() {
        $UserDiscordModel = model('UserDiscordModel');
        $UserDiscordModel->delete($this->attributes['id']);
    }

    public function hasGithub() : bool {
        $UserGithubModel = model('UserGithubModel');
        return boolval($UserGithubModel->where('user',$this->attributes['id'])->first());
    }

    public function hasDiscord() : bool {
        $UserDiscordModel = model('UserDiscordModel');
        return boolval($UserDiscordModel->where('user',$this->attributes['id'])->first());
    }

    public function sendPasswordRecovery() {
        helper('text');
        $token = random_string('alnum',32);

        $RecovPassModel = model('UserPasswordRecoveryModel');

        if ($RecovPassModel->find($this->attributes['id']) != null) {
            return false;
        }

        $RecovPassModel->insert(['user' => $this->attributes['id'], 'token' => password_hash($token, PASSWORD_DEFAULT)]);

        $email = \Config\Services::email();

        $email->setTo($this->attributes['email']);
        $email->setSubject('Recover your password');
        $email->setMessage("To Recover your password, please click on the following link: <a href='".site_url('authentication/recoverpassword?id='.$this->attributes['id'].'&token='.$token)."'>Recover Password</a> <br> If you did not request this, please ignore this email.");

        return $email->send();
    }

    public function recoverPassword($token, $newpass) {
        $RecovPassModel = model('UserPasswordRecoveryModel');

        if (! $this->validatePasswordRecovery($token)) {
            return false;
        }
        
        model('UserModel')->update($this->attributes['id'], ['password' => password_hash($newpass, PASSWORD_DEFAULT)]);
        $RecovPassModel->delete($this->attributes['id']);

        $email = \Config\Services::email();

        $email->setTo($this->attributes['email']);
        $email->setSubject('Security Alert');
        $email->setMessage("Your password has been changed. If you did not request this, please contact us. <br> If you did, please ignore this email.");

        return $email->send();

        return true;
    }

    public function validatePasswordRecovery($token) {
        $RecovPassModel = model('UserPasswordRecoveryModel');

        $recovPass = $RecovPassModel->find($this->attributes['id']);

        if ($recovPass == null) {
            return false;
        }
        if ($recovPass['expiration_date'] < date('Y-m-d H:i:s')) {
            $RecovPassModel->delete($this->attributes['id']);
            return false;
        }
        
        if (password_verify($token, $recovPass['token'])) {
            return true;
        }
        return false;
    }
}