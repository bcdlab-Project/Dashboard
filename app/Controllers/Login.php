<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function getIndex() {
        $session = session();

        $data['title'] = 'Login';
        $data['pageMargin'] = false;

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => 'dashboard',
            'clientSecret'            => 'qeuw115GcKnk7iKOOgNJHsyVqaTn6C0s',
            'redirectUri'             => 'http://192.168.22.48/login',
            'urlAuthorize'            => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/auth',
            'urlAccessToken'          => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/token',
            'urlResourceOwnerDetails' => 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/userinfo',
            'scopes' => 'openid profile email offline_access',
        ]);
        
        if (!isset($_GET['code'])) {
            $authorizationUrl = $provider->getAuthorizationUrl();
        
            $session->set('oauth2state', $provider->getState());
        
            return redirect()->to($authorizationUrl);

        } elseif (empty($_GET['state']) || empty($session->get('oauth2state')) || $_GET['state'] !== $session->get('oauth2state')) {
            if ($session->has('oauth2state')) {
                $session->remove('oauth2state');
            }
        
            return view('templates/header', $data)
            . view('login')
            . view('templates/footer');
        
        } else {
            try {
                $accessToken = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);

                $user = $provider->getResourceOwner($accessToken)->toArray();
            
                $userData = [
                    'id' => $user['user_id'],
                    'oauth_id' => $user['sub'],
                    'username' => $user['preferred_username'],
                    'roles' => $user['dashboard']['roles'],
                    'email' => $user['email']
                ];

                $session->set('loggedIn',true);
                $session->set('user_data',$userData);

                return redirect()->to('/'); // give success

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        
                // Failed to get the access token or user details.
                // exit($e->getMessage());

                return view('templates/header', $data)
                . view('login')
                . view('templates/footer');
            }
        }
    }
}