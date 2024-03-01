<?php

namespace App\Controllers\Api\Integration;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Github extends Controller
{
    use ResponseTrait;

    private $authorizeURL; 
    private $tokenURL;
    private $apiURLBase;

    private $app_id;
    private $client_id;
    private $client_secret;

    private $redirect_url;

    private $private_key;

    public function __construct() {
        $config = config('GithubIntegration');
        $this->authorizeURL = $config->authorizeURL;
        $this->tokenURL = $config->tokenURL;
        $this->apiURLBase = $config->apiURLBase;
        $this->app_id = $config->app_id;
        $this->client_id = $config->client_id;
        $this->client_secret = $config->client_secret;
        $this->redirect_url = $config->redirect_url;
        $this->private_key = $config->private_key;
    }

    public function getIndex() {
        return $this->fail("Error",400);
    }

    public function getGo($mode = false) {
        helper('permissions');
        $session = session();

        if (!$mode || ($mode != 'login' && $mode != 'connect' && $mode != 'disconnect')) { return $this->fail("Error",400); }

        if ($mode == 'connect' && !loggedIn_Permission()) { return $this->fail("Error",401); } // give error

        $check = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $session->set('GitHubCheck',$check);

        $url = $this->authorizeURL . '?' . http_build_query([ 
            'client_id' => $this->client_id, 
            'redirect_uri' => $this->redirect_url, 
            'state' => $mode . '|' . $check, 
            'scope' => 'user' 
        ]);

        return $this->setResponseFormat('json')->respond(['ok' => true, 'url' => $url],200);
    }

    public function getCallback() {
        $request = service('request');
        $session = session();

        $code = $request->getGet('code');
        $state = explode('|',strval($request->getGet('state')));

        if (empty($code)) { return $this->fail("Error",400); } // give error
        if ($session->get('GitHubCheck') != $state[1]) { return $this->fail("Error",400); } //can also give error

        $tokenData =  $this->extchangeToken($code);

        $githubUserData = $this->extchangeUserdata($tokenData['access_token']);


        switch ($state[0]) {
            case 'login':
                return redirect()->to('/authentication/github?key=' . $state[1]);
                break;
            case 'connect':
                helper('permissions');

                if (!loggedIn_Permission()) {
                    return redirect()->to('/authentication/login'); //give error
                }
        
                $userModel = model('UserModel');
                $user = $userModel->find($session->get('user_data')['id']);
                $user->setGithub($githubUserData, $tokenData);
         
                $this->session->remove('GitHubCheck');
                $this->session->remove('GitHubToken');
        
                return redirect()->to('/profile');
                break;
            case 'disconnect':
                helper('permissions');

                if (!loggedIn_Permission()) {
                    return redirect()->to('/authentication/login'); //give error
                }
        
                if ($this->session->get('GitHubCheck') != $this->request->getGet('key')) {  } //give error
        
                $userModel = model('UserModel');
                $user = $userModel->find($session->get('user_data')['id']);
                $user->unsetGithub();
        
                return redirect()->to('/profile');
            default:
                return redirect()->to('/'); //give error
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

        if ($http_code != 200 || isset($resp['error'])) { return false; } //can also give error

        return $resp;
    }

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

        $resp = $response->getBody(); 
        $http_code = $response->getStatusCode();          
        
        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return false; }
        return $resp;
    }

    private function exchangeJwJ() {
        $payload = [
            'iss' => intval($this->app_id),
            'iat' => time() - 60,
            'exp' => time() + (3 * 60)
        ];

        $jwt = JWT::encode($payload, $this->private_key, 'RS256');

        return $jwt;
    }

    public function getTest() {
        echo $this->exchangeJwJ();
    }
}