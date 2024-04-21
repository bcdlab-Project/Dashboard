<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;

    public function getIndex() {
        return "<!doctype html><html><body><script src='/js/keycloak.min.js' type='text/javascript'></script><script src=/js/auth/login.js></script></body></html>";
    }
    
    public function postAuto() {

        if ($this->request->getPost('token') == null) {
            return $this->fail("Error",400);
        }

        $session = session();

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => 'dashboard',
            'redirectUri'             => 'https://dash.bcdlab.xyz/login',
            'urlAuthorize'            => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/auth',
            'urlAccessToken'          => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/token',
            'urlResourceOwnerDetails' => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/userinfo',
            'scopes' => 'openid profile email offline_access',
        ]);

        $accessToken = new \League\OAuth2\Client\Token\AccessToken(['access_token' => $this->request->getPost('token')]);

        try {
            $user = $provider->getResourceOwner($accessToken)->toArray();
        } catch (\UnexpectedValueException $e) {
            return $this->fail($e->getMessage(),403);
        }

        $userData = [
            'id' => $user['user_id'],
            'oauth_id' => $user['sub'],
            'username' => $user['preferred_username'],
            'roles' => $user['roles'],
            'email' => $user['email']
        ];

        $session->set('loggedIn',true);
        $session->set('user_data',$userData);
    }

    public function getSilentCheck() {
        return "<!doctype html><html><body><script src='/js/auth/silentCheck.js'></script></body></html>";
    }

    public function getUnauthorized() {
        session()->destroy();
    }

    public function getLogout() {
        if ($this->session->get('loggedIn')) {
            $this->session->destroy();
            return $this->setResponseFormat('json')->respond(['ok' => true],200);
        }
        return $this->fail("Error",403);
    }
}