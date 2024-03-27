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

        $EmailConfModel->insert(['participation_form' => $this->attributes['id'], 'token' => password_hash($token, PASSWORD_DEFAULT)]);

        $email = \Config\Services::email();

        $email->setTo($this->attributes['requested_email']);
        $email->setSubject('Confirm your email to participate');
        $email->setMessage("To Confirm Your Email, please click on the following link: <a href='".site_url('participate/confirmEmail?id='.$this->attributes['id'].'&token='.$token)."'>Confirm Email</a>");

        return $email->send();
    }

    function hasExpiredEmailConfirmation() {
        $EmailConfModel = model('ParticipationFormEmailConfirmationModel');
        $ParticipationFormModel = model('ParticipationFormModel');

        $emailConf = $EmailConfModel->find($this->attributes['id']);

        if ($emailConf == null) {
            return true;
        }

        $result = $emailConf['expiration_date'] < date('Y-m-d H:i:s');

        if ($result) {
            $EmailConfModel->delete($this->attributes['id']);
            $ParticipationFormModel->delete($this->attributes['id']);
        }

        return $result;
    }

    function confirmEmail($token) {
        $EmailConfModel = model('ParticipationFormEmailConfirmationModel');

        $emailConf = $EmailConfModel->find($this->attributes['id']);

        if ($emailConf == null) {
            return false;
        }
        
        if ($emailConf['expiration_date'] < date('Y-m-d H:i:s')) {
            return false;
        }

        if (password_verify($token, $emailConf['token'])) {
            return false;
        }

        $EmailConfModel->delete($this->attributes['id']);
        return true;
    }

    function hasEmailConfirmed() {
        $EmailConfModel = model('ParticipationFormEmailConfirmationModel');

        return $EmailConfModel->find($this->attributes['id']) == null;
    }
    
}