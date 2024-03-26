<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ParticipationForm extends Entity
{
    function initializeEmailConfirmation() {
        helper('text');
        $token = random_string('alnum',32);

        $EmailConfModel = model('ParticipationFormEmailConfirmationModel');

        if ($EmailConfModel->find($this->attributes['id']) != null) {
            return false;
        }

        $EmailConfModel->insert(['participation_form' => $this->attributes['id'], 'token' => $token]);

        $email = \Config\Services::email();

        $email->setTo($this->attributes['requested_email']);
        $email->setSubject('Confirm your email to participate');
        $email->setMessage("To Confirm Your Email, please click on the following link: <a href='".site_url('participate/confirmEmail?id='.$this->attributes['id'].'&email='.$this->attributes['requested_email'].'&token='.$token)."'>Confirm Email</a>");

        return $email->send();
    }
    
}