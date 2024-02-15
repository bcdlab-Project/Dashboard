<?php 

namespace Config;

use CodeIgniter\Config\BaseConfig;

class GithubIntegration extends BaseConfig
{
    // URLs
    public string $authorizeURL = 'https://github.com/login/oauth/authorize';
    public string $tokenURL = 'https://github.com/login/oauth/access_token';
    public string $apiURLBase = 'https://api.github.com';

    // App credentials
    public string $client_id = 'Iv1.b61d048cb4fec2c8';
    public string $client_secret = '165593399c84007f2f1eb610bbc42aab2a2ae38f';
    public string $private_key = '';

    // Other Configs
    public string $redirect_url = 'http://192.168.22.48/github_integration/callback';
}
