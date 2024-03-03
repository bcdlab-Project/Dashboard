<?php

namespace App\Controllers\Api\Integration;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Discord extends Controller
{
    use ResponseTrait;

    private $authorizeURL;
    private $tokenURL;

    private $client_id;
    private $client_secret;

    private $redirect_url;
    private $apiURLBase;

    public function __construct()
    {
        $config = config('DiscordIntegration');
        $this->authorizeURL = $config->authorizeURL;
        $this->tokenURL = $config->tokenURL;

        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;

        $this->redirect_url = $config->redirect_url;
        $this->apiURLBase = $config->apiURLBase;
    }

    private function prepareURL($mode) {
        $session = session();

        $check = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $session->set('DiscordCheck',$check);

        return $this->authorizeURL . '?' . http_build_query([ 
            'response_type'=> 'code',
            'client_id' => $this->client_id,
            'scope' => 'identify',
            'state' => $mode . '|' . $check,
            'redirect_uri' => $this->redirect_url, 
            'prompt' => 'consent', 
        ]);
    }

    public function getConnect() {
        $session = session();
        helper('permissions');

        if (!loggedIn_Permission()) { return $this->fail("Error",401); } // give error

        $UserDiscordModel = model('UserDiscordModel');
        if ($UserDiscordModel->find($session->get('user_data')['id'])) { return $this->fail("Error",400); } // give error

        return $this->setResponseFormat('json')->respond(['ok' => true, 'url' => $this->prepareURL("connect")],200);
    }

    public function getDisconnect() {
        helper('permissions');
        $session = session();

        if (!loggedIn_Permission()) { return $this->fail("Error",401); } // give error

        $UserDiscordModel = model('UserDiscordModel');
        if (!$UserDiscordModel->find($session->get('user_data')['id'])) { return $this->fail("Error",400); } // give error

        $userModel = model('UserModel');
        $user = $userModel->find($session->get('user_data')['id']);
        $user->unsetDiscord();

        return $this->setResponseFormat('json')->respond(['ok' => true],200);
    }

    public function getCallback() {
        $request = service('request');
        $session = session();

        $code = $request->getGet('code');
        $state = explode('|',strval($request->getGet('state')));

        if (empty($code)) { return $this->fail("Error",400); } // give error
        if ($session->get('DiscordCheck') != $state[1]) { return $this->fail("Error",400); } // give error

        $tokenData = $this->extchangeToken($code);
        
        $DiscordUserData = $this->extchangeUserdata($tokenData['access_token']);

        switch ($state[0]) {
            case 'connect':
                helper('permissions');

                if (!loggedIn_Permission()) {
                    return $this->fail("Error",401); //give error
                }
        
                $userModel = model('UserModel');
                $user = $userModel->find($session->get('user_data')['id']);
                $user->setDiscord($DiscordUserData);
         
                $session->remove('DiscordCheck');
        
                return "<script>localStorage.setItem('externalDiscordPageDone', 'true'); window.close()</script>";
                break;
            default:
                return $this->fail("Error",400); //give error
                break;
        }
    }

    private function extchangeToken($code) {
        $client = \Config\Services::curlrequest();

        $response = $client->request('POST', $this->tokenURL, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $this->redirect_url
            ],
            'auth' => [
                $this->client_id,
                $this->client_secret
            ]
        ]);

        $resp = $response->getBody(); 
        $http_code = $response->getStatusCode();

        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return false; } //can also give error

        return $resp;
    }

    private function extchangeUserdata($token) {
        $apiURL = $this->apiURLBase . '/users/@me'; 

        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', $apiURL, [
            'headers' => [
                'Authorization' => 'Bearer '. $token,
            ],
        ]);
    
        $resp = $response->getBody(); 
        $http_code = $response->getStatusCode();          
        
        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return false; }
        return $resp;
    }
}