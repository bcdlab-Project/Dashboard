<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Node extends Entity
{

    public function getDetails() {
        $NodeFormModel = model('NodeFormModel');
        return $NodeFormModel->find($this->attributes['id']);
    }

    public function getstatus() {
        $RunningNodesModel = model('RunningNodesModel');
        $runningNode = $RunningNodesModel->where('id', $this->attributes['id'])->first();
        return $runningNode && $runningNode['connected'] == 1;
    }
    
}