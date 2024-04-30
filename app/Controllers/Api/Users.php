<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;


class Users extends Controller
{
    use ResponseTrait;

    // ------------------------ Get Data ------------------------ //
    public function getIndex($id = false, $action = false) {
        helper('permissions');
        if (!loggedIn_Permission() || (!$id && !admin_Permission()) || (!own_Permission($id) && !admin_Permission())) { return $this->failUnauthorized(); }

        if (!$id && !$action) {
            if (!admin_Permission()) { return $this->failUnauthorized(); }
            $users = model('UserModel')->findAll();
            $data['users'] = [];
            foreach ($users as $user) {
                $keycloakData = $user->keycloakData();

                $data['users'][] = [
                    'id' => $user->id,
                    'oauth_id' => $user->oauth_id,
                    'username' => $keycloakData['username'],
                    'roles' =>  $user->getRoles(),
                    'email' => $keycloakData['email'],
                    'created_at' => $user->created_at,
                    'last_updated' => $user->last_updated,
                    'banned' => $user->banned,
                    'deleted' => $user->deleted,
                    'has_github' => $user->hasGithub(),
                    'has_discord' => $user->hasDiscord()
                ];
            }
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }

        if ($id == 'me') { $id = session()->get('user_data')['id']; }

        switch ($action) {
            case false:
                return $this->userData($id);
                break;
            case 'github':
                return $this->github($id);
                break;
            case 'discord':
                return $this->discord($id);
                break;
            default:
                return $this->fail('Invalid Action', 400);
        }
    }

    // ------------------------ Get Data Actions ------------------------ //

    // ------------ Get User Data ------------ //
    private function userData($id) {
        $user = model('UserModel')->where('id', $id)->first();
        if ($user) {
            $keycloakData = $user->keycloakData();
            $data = [
                'id' => $user->id,
                'username' => $keycloakData['username'],
                'roles' =>  $user->getRoles(),
                'email' => $keycloakData['email'],
                'created_at' => $user->created_at,
                'last_updated' => $user->last_updated,
                'banned' => $user->banned,
                'deleted' => $user->deleted,
                'has_github' => $user->hasGithub(),
                'has_discord' => $user->hasDiscord()
            ];
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }
        return $this->fail('Not Found',404);
    }

    // ------------ Get Discord Data ------------ //
    private function discord($id) {
        $user = model('UserModel')->where('id', $id)->first();
        if ($user) {
            $data = $user->getDiscord();
            if (!$data) { $data = ['id' => false, 'username' => '-- N/A --']; }
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }
        return $this->fail('Not Found',404);
    }

    // ------------ Get Github Data ------------ //
    private function github($id) {
        $user = model('UserModel')->where('id', $id)->first();
        if ($user) {
            $data = $user->getGithub();
            if (!$data) { $data = ['id' => false, 'username' => '-- N/A --']; }
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }
        return $this->fail('Not Found',404);
    }


    // ------------------------ Set Data ------------------------ //
    public function postIndex($id = false, $action = false) {
        helper('permissions');
        if (!loggedIn_Permission() || (!$id && !admin_Permission()) || (!own_Permission($id) && !admin_Permission())) { return $this->failUnauthorized(); }
        if (!$id && !$action) { return $this->fail('Invalid', 400); }
        if ($id == 'me') { $id = session()->get('user_data')['id']; }

        switch ($action) {
            case 'email':
                if (!$this->validateData(['email' => service('request')->getPost('email')], ['email' => 'required|max_length[254]|valid_email'])) { return $this->setResponseFormat('json')->fail(str_replace('email','Email',$this->validator->getErrors()['email']), 400); }
                return $this->updateEmail($id);
                break;
            case 'password':
                return $this->updatePassword($id);
                break;
            default:
                return $this->fail('Invalid Action', 400);
        }
    }

    // ------------------------ Set Data Actions ------------------------ //
    
    // ------------ Set Email ------------ //
    private function updateEmail($id) {
        $user = model('UserModel')->find($id);
        if ($user) {
            if ($user->setEmail(service('request')->getPost('email'))) {
                $user->verifyEmail();
                return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
            }
            return $this->fail('Error', 400);
        }
        return $this->fail('Not Found',404);
    }

    // ------------ Set Password ------------ //
    private function updatePassword($id) {
        $user = model('UserModel')->find($id);
        if ($user) {
            helper('keycloak');
            $keycloak = initKeycloak();
            $keycloak->executeActionsEmail(['id' => $user->oauth_id, 'actions' => ['UPDATE_PASSWORD']]);

            return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        }
        return $this->fail('Not Found',404);
    }


}