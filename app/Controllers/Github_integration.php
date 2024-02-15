<?php

namespace App\Controllers;

class Github_integration extends BaseController
{

    
    private $authorizeURL; 
    private $tokenURL;
    private $apiURLBase;

    private $client_id;
    private $client_secret;

    private $redirect_url;

    private $private_key;

    public function __construct() {
        $config = config('GithubIntegration');
        $this->authorizeURL = $config->authorizeURL;
        $this->tokenURL = $config->tokenURL;
        $this->apiURLBase = $config->apiURLBase;
        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;
        $this->redirect_url = $config->redirect_url;
        $this->private_key = $config->private_key;
    }

    public function getIndex() {
        return redirect()->to('/');
    }

    public function getLogin() {
        $check = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $this->session->set('GitHubCheck',$check);

        $url = $this->authorizeURL . '?' . http_build_query([ 
            'client_id' => $this->client_id, 
            'redirect_uri' => $this->redirect_url, 
            'state' => 'login|' . $check, 
            'scope' => 'user' 
        ]);

        return redirect()->to($url);
    }

    public function getCallback() {
        $code = $this->request->getGet('code');
        $state = explode('|',strval($this->request->getGet('state')));

        if (empty($code)) { return $this->getLogin(); }
        if ($this->session->get('GitHubCheck') != $state[1]) { return redirect()->to('/'); } //can also give error

        $this->extchangeToken($code);

        switch ($state[0]) {
            case 'login':
                $this->extchangeUserdata();
                return redirect()->to('/login/github?key=' . $state[1]);
                break;
        }
    }

    private function extchangeToken($code) {
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

        $resp = $response->getBody(); 
        $http_code = $response->getStatusCode();

        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return redirect()->to('/'); } //can also give error

        $this->session->set('GitHubToken',$resp);
    }

    public function extchangeUserdata() {
        $apiURL = $this->apiURLBase . '/user'; 

        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', $apiURL, [
            'headers' => [
                'User-Agent' => 'bcdlab Project GitHub OAuth Login',
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json', 
                'Authorization' => 'token '. $this->session->get('GitHubToken')['access_token'],
            ],
        ]);

        $resp = $response->getBody(); 
        $http_code = $response->getStatusCode();          
        
        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return redirect()->to('/'); } //can also give error
        $this->session->set('GitHubUserData',$resp);
    }
}