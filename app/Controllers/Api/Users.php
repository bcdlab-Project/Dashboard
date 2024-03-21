<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Users extends Controller
{
    use ResponseTrait;
    
    public function getIndex($id = false, $action = false) {
        helper('permissions');
        helper('roles');
        $request = service('request');

        if (!loggedIn_Permission() || (!$id && !admin_Permission()) || (!own_Permission($id) && !admin_Permission())) {
            return $this->setResponseFormat('json')->respond(['ok'=>false], 401);
        }

        $usermodel = model('UserModel');

        if (!$id && !$action) {
            if (!admin_Permission()) { return $this->setResponseFormat('json')->respond(['ok'=>false], 401); }
            $users = $usermodel->findAll();
            $data['users'] = [];
            foreach ($users as $user) {
                $data['users'][] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => getRoleInfo($user->role),
                    'email' => $user->email,
                    'participation_form' => $user->participation_form,
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

        if ($id && !$action) {
            $user = $usermodel->where('id', $id)->first();
            if ($user) {
                $data = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => getRoleInfo($user->role),
                    'email' => $user->email,
                    'participation_form' => $user->participation_form,
                    'created_at' => $user->created_at,
                    'last_updated' => $user->last_updated,
                    'banned' => $user->banned,
                    'deleted' => $user->deleted,
                    'has_github' => $user->hasGithub(),
                    'has_discord' => $user->hasDiscord()
                ];
                return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
            }
            return $this->setResponseFormat('json')->respond(['ok'=>false], 404);
        }

        // if (!$id && !$action) {
        //     $users = $usermodel->findAll();
        //     return $this->setResponseFormat('json')->respond($users, 200);
        // }

        if ($id && $action == 'github') {
            $user = $usermodel->where('id', $id)->first();
            if ($user) {
                $data = $user->getGithub();
                if (!$data) {
                    $data = [
                        'id' => false,
                        'username' => '-- N/A --',
                        'last_loggedin' => '-- N/A --',
                        'created_at' => '-- N/A --',
                    ];
                }
                return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
            }
            return $this->setResponseFormat('json')->respond(['ok'=>false], 404);
        }

        if ($id && $action == 'discord') {
            $user = $usermodel->where('id', $id)->first();
            if ($user) {
                $data = $user->getDiscord();
                if (!$data) {
                    $data = [
                        'id' => false,
                        'username' => '-- N/A --',
                        'created_at' => '-- N/A --',
                    ];
                }
                return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
            }
            return $this->setResponseFormat('json')->respond(['ok'=>false], 404);
        }


        // if ($id && $action == 'delete') {
        //     $user = $usermodel->where('id', $id)->first();
        //     if ($user) {
        //         $user->delete();
        //         return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        //     }
        // }
        // if ($id && $action == 'update') {
        //     $user = $usermodel->where('id', $id)->first();
        //     if ($user) {
        //         $user->fill($request->getPost());
        //         $user->save();
        //         return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        //     }
        // }
        // if (!$id && $action == 'create') {
        //     $user = new \App\Entities\User();
        //     $user->fill($request->getPost());
        //     $user->save();
        //     return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        // }



        return $this->setResponseFormat('json')->respond(['nodes'=>true], 200);
    }

}