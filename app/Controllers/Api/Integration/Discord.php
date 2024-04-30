<?php

namespace App\Controllers\Api\Integration;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Discord extends Controller
{
    use ResponseTrait;

    // ------------------------ Prepare Configs ------------------------ //

    // ------------ Prepare Variables ------------ //
    private $authorizeURL;
    private $tokenURL;
    private $client_id;
    private $client_secret;
    private $redirect_url;
    private $apiURLBase;

    // ------------ Set Variables ------------ //
    public function __construct() {
        $config = config('DiscordIntegration');
        $this->authorizeURL = $config->authorizeURL;
        $this->tokenURL = $config->tokenURL;
        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;
        $this->redirect_url = $config->redirect_url;
        $this->apiURLBase = $config->apiURLBase;
    }

    // ------------------------ Default ------------------------ //
    public function getIndex() { return $this->fail("Error",400); }

    // ------------------------ Connect Discord ------------------------ //
    public function getConnect() {
        $session = session();
        helper('permissions');

        $UserId = $session->get('user_data')['id'];

        if (!loggedIn_Permission() || !own_Permission($UserId)) { return $this->failUnauthorized(); } // give error

        $userModel = model('UserModel');
        if ($userModel->find($UserId)->hasDiscord()) { return $this->fail("Error",400); } // give error

        $check = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $session->set('DiscordCheck',$check);

        $authorizationURL = $this->authorizeURL . '?' . http_build_query([ 
            'response_type'=> 'code',
            'client_id' => $this->client_id,
            'scope' => 'identify',
            'state' => $check,
            'redirect_uri' => $this->redirect_url, 
            'prompt' => 'consent', 
        ]);

        return $this->setResponseFormat('json')->respond(['ok' => true, 'url' => $authorizationURL],200);
    }

    // ------------------------ Disconnect Discord ------------------------ //
    public function getDisconnect() {
        helper('permissions');
        $session = session();

        $UserId = $session->get('user_data')['id'];

        if (!loggedIn_Permission() || !own_Permission($UserId)) { return $this->failUnauthorized(); } // give error

        $userModel = model('UserModel');
        $user = $userModel->find($UserId);

        if (!$user->hasDiscord()) { return $this->fail("Error",400); } // give error

        $user->unsetDiscord();

        return $this->setResponseFormat('json')->respond(['ok' => true],200);
    }

    // ------------------------ Callback ------------------------ //
    public function getCallback() {
        helper('permissions');
        if (!loggedIn_Permission()) { return $this->failUnauthorized(); } //give error

        $request = service('request');
        $session = session();
        $userModel = model('UserModel');

        $code = $request->getGet('code');

        if (empty($code)) { return $this->fail("Error",400); } // give error
        if ($session->get('DiscordCheck') != strval($request->getGet('state'))) { return $this->fail("Error",400); } // give error

        $access_token = $this->extchangeAccessToken($code);

        if (!$access_token) { return $this->fail("Error",400); } //give error
        
        $DiscordUserData = $this->extchangeUserdata($access_token);

        $user = $userModel->find($session->get('user_data')['id']);
        $user->setDiscord($DiscordUserData);
    
        $session->remove('DiscordCheck');

        return "<script src='/js/integration/discord_callback.js'></script>";
    }

    // ------------------------ Private Functions ------------------------ //

    // ------------ Exchange Access Token ------------ //
    private function extchangeAccessToken($code) {
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

        $http_code = $response->getStatusCode();
        $resp = json_decode($response->getBody(),true);

        if ($http_code != 200 || isset($resp['error'])) { return false; } //can also give error

        return $resp['access_token'];
    }

    // ------------ Exchange User Data ------------ //
    private function extchangeUserdata($token) {
        $apiURL = $this->apiURLBase . '/users/@me'; 

        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', $apiURL, [
            'headers' => [
                'Authorization' => 'Bearer '. $token,
            ],
        ]);
    
        $http_code = $response->getStatusCode();          
        $resp = json_decode($response->getBody(),true);

        if ($http_code != 200 || isset($resp['error'])) { return false; }
        return $resp;
    }
}