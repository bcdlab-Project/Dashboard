<?php

namespace App\Controllers;

class Github_integration extends BaseController
{
    private $authorizeURL = "https://github.com/login/oauth/authorize"; 
    private $tokenURL = "https://github.com/login/oauth/access_token";
    private $apiURLBase = "https://api.github.com";

    private $client_id = 'Iv1.b61d048cb4fec2c8';
    private $client_secret = "165593399c84007f2f1eb610bbc42aab2a2ae38f";

    private $redirect_url = 'http://192.168.22.48/github_integration/callback';

    private $private_key = '';



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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->tokenURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'bcdlab Project GitHub OAuth Login'); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query([ 
            'client_id' => $this->client_id, 
            'client_secret' => $this->client_secret, 
            'code' => $code 
        ]));

        $resp = curl_exec($ch); 
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

        parse_str($resp, $resp);

        if ($http_code != 200 || isset($resp['error'])) { return redirect()->to('/'); } //can also give error

        $this->session->set('GitHubToken',$resp);
    }

    public function extchangeUserdata() {
        $apiURL = $this->apiURLBase . '/user'; 
         
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $apiURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: token '. $this->session->get('GitHubToken')['access_token'])); 
        curl_setopt($ch, CURLOPT_USERAGENT, 'bcdlab Project GitHub OAuth Login'); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
        $resp = curl_exec($ch); 
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);          
        
        
        $resp = json_decode($resp,true);

        if ($http_code != 200 || isset($resp['error'])) { return redirect()->to('/'); } //can also give error
        $this->session->set('GitHubUserData',$resp);
    }
}