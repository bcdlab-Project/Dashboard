<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Users extends Controller
{
    use ResponseTrait;
    
    public function getIndex($id = false, $action = false) {
        helper('permissions');

        if (!loggedIn_Permission() || (!$id && !admin_Permission()) || ($id && !own_Permission($id) && !admin_Permission())) {
            return $this->setResponseFormat('json')->respond(['ok'=>false], 401);
        }

        $usermodel = model('UsersModel');

        if ($id && !$action) {
            $user = $usermodel->where('id', $id)->first();
            if ($user) {
                return $this->setResponseFormat('json')->respond($user, 200);
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
        //         $user->fill($this->request->getPost());
        //         $user->save();
        //         return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        //     }
        // }
        // if (!$id && $action == 'create') {
        //     $user = new \App\Entities\User();
        //     $user->fill($this->request->getPost());
        //     $user->save();
        //     return $this->setResponseFormat('json')->respond(['ok'=>true], 200);
        // }



        return $this->setResponseFormat('json')->respond(['nodes'=>true], 200);
    }

}