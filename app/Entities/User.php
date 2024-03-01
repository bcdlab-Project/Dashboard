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
}