<?php

namespace App\Controllers\Api\Integration;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Github extends Controller
{
    use ResponseTrait;

    // ------------------------ Prepare Configs ------------------------ //

    // ------------ Prepare Variables ------------ //
    private $authorizeURL; 
    private $tokenURL;
    private $apiURLBase;
    private $app_id;
    private $client_id;
    private $client_secret;
    private $redirect_url;

    // ------------ Set Variables ------------ //
    public function __construct() {
        $config = config('GithubIntegration');
        $this->authorizeURL = $config->authorizeURL;
        $this->tokenURL = $config->tokenURL;
        $this->apiURLBase = $config->apiURLBase;
        $this->app_id = $config->app_id;
        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;
        $this->redirect_url = $config->redirect_url;
    }

    // ------------------------ Default ------------------------ //
    public function getIndex() { return $this->fail("Error",400); }

    // ------------------------ Connect Github ------------------------ //
    public function getConnect() {
        $session = session();
        helper('permissions');

        $UserId = $session->get('user_data')['id'];

        if (!loggedIn_Permission() || !own_Permission($UserId)) { return $this->failUnauthorized(); } // give error

        $UserModel = model('UserModel');

        if ($UserModel->find($UserId)->hasGithub()) { return $this->failForbidden('User Already has GitHub'); } // give error

        $check = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $session->set('GitHubCheck',$check);

        $authorizationURL = $this->authorizeURL . '?' . http_build_query([ 
            'client_id' => $this->client_id, 
            'redirect_uri' => $this->redirect_url, 
            'state' => $check, 
            'scope' => 'user' 
        ]);

        return $this->setResponseFormat('json')->respond(['ok' => true, 'url' => $authorizationURL],200);
    }

    // ------------------------ Disconnect Github ------------------------ //
    public function getDisconnect() {
        helper('permissions');
        $session = session();

        $UserId = $session->get('user_data')['id'];

        if (!loggedIn_Permission() || !own_Permission($UserId)) { return $this->failUnauthorized(); } // give error

        $UserModel = model('UserModel');
        $user = $UserModel->find($UserId);

        if (!$user->hasGithub()) { return $this->failForbidden('User does not have GitHub'); } // give error

        $user->unsetGithub();

        return $this->setResponseFormat('json')->respond(['ok' => true],200);
    }

    // ------------------------ Callback ------------------------ //
    public function getCallback() {
        helper('permissions');
        if (!loggedIn_Permission()) { return redirect()->to('/login'); } //give error
        
        $request = service('request');
        $session = session();
        $userModel = model('UserModel');

        $code = $request->getGet('code');

        if (empty($code)) { return $this->fail("Error",400); } // give error
        if ($session->get('GitHubCheck') != strval($request->getGet('state'))) { return $this->fail("Error",400); } //give error

        $access_token = $this->extchangeAccessToken($code);

        if (!$access_token) { return $this->fail("Error",400); } //give error

        $githubUserData = $this->extchangeUserdata($access_token);

        $user = $userModel->find($session->get('user_data')['id']);
        $user->setGithub($githubUserData);
    
        $session->remove('GitHubCheck');

        return "<script src='/js/integration/github_callback.js'></script>";
    }

    // ------------------------ Private Functions ------------------------ //

    // ------------ Exchange Access Token ------------ //
    private function extchangeAccessToken($code) {
        $client = \Config\Services::curlrequest();

        $response = $client->request('POST', $this->tokenURL, [
            'headers' => [
                'User-Agent' => 'bcdlab Project GitHub OAuth Login',
                'Accept'     => 'application/json',
            ],
            'form_params' => [
                'client_id' => $this->client_id, 
                'client_secret' => $this->client_secret, 
                'code' => $code,
            ],
        ]);
 
        $http_code = $response->getStatusCode();
        $resp = json_decode($response->getBody(),true);

        if ($http_code != 200 || isset($resp['error'])) { return false; } //can also give error

        return $resp['access_token'];
    }

    // ------------ Exchange User Data ------------ //
    private function extchangeUserdata($token) {
        $apiURL = $this->apiURLBase . '/user'; 

        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', $apiURL, [
            'headers' => [
                'User-Agent' => 'bcdlab Project GitHub OAuth Login',
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json', 
                'Authorization' => 'token '. $token,
            ],
        ]);

        $http_code = $response->getStatusCode();          
        $resp = json_decode($response->getBody(),true);

        if ($http_code != 200 || isset($resp['error'])) { return false; }
        return $resp;
    }
}