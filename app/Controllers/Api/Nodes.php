<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Nodes extends Controller
{
    use ResponseTrait;
    
    public function getIndex($id = false,$action = false) {
        helper('permissions');
        if (!admin_Permission() && !collaborator_Permission()) { return $this->failUnauthorized(); }


        if (!$id && !$action) {
            $nodes = model('NodeModel')->findAll();

    
            if ($nodes) {
                foreach ($nodes as $node) {
                    $details = $node->getDetails();
                    unset($node->secret);
                    unset($node->tunnel_Credentials);
                    $node->owner = $details->owner;
                    $node->status = $node->getstatus();
                    $node->owner_name = model('UserModel')->where('id', $details->owner)->first()->keycloakData()['username'];
                    $node->alias = $details->alias;
                    $node->description = $details->description;
                }
            }
    
            if (!admin_Permission()) {
                $nodes = array_filter($nodes, function($node) {
                    return $node->owner == session()->get('user_data')['id'];
                });
            }
    
            return $this->setResponseFormat('json')->respond(['ok'=>true,'nodes'=>$nodes], 200);
        }

        if ($id && !$action) {
            $node = model('NodeModel')->find($id);
            if (!$node) {
                return $this->fail('Not Found',404);
            }
            $details = $node->getDetails();
            $data['id'] = $node->id;
            $data['tunnel_UUID'] = $node->tunnel_UUID;
            $data['last_updated'] = $node->last_updated;
            $data['owner'] = $details->owner;
            $data['status'] = $node->getstatus();
            $data['owner_name'] = model('UserModel')->where('id', $details->owner)->first()->keycloakData()['username'];
            $data['alias'] = $details->alias;
            $data['description'] = $details->description;
            return $this->setResponseFormat('json')->respond(array_merge($data,['ok'=>true]), 200);
        }

    }

    public function getRegisterNode() {
        return $this->setResponseFormat('json')->respond(['registernodes'=>true], 200);
    }




}