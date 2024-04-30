<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    // -------------------------------------- User Data -------------------------------------- //

    // ------------------- Set User Data ------------------- //

    // Set Username
    public function setEmail(string $email) {
        helper('keycloak');
        return boolval(!isset(initKeycloak()->updateUser(['id' => $this->attributes['oauth_id'],'email' => $email])['errorMessage']));
    }

    // ------------------- Get User Data ------------------- //

    // Get Keycloak Data
    public function keycloakData() {
        helper('keycloak');
        $keycloak = initKeycloak();

        return $keycloak->getUser(['id' => $this->attributes['oauth_id']]);
    }

    // Get Roles
    public function getRoles() {
        helper('keycloak');
        $keycloak = initKeycloak();

        $roles = $keycloak->getUserRoleMappings(['id' => $this->attributes['oauth_id']])['clientMappings']['dashboard']['mappings'];

        $realRoles = array();

        foreach ($roles as $role) {
            $realRoles[] = ($role['name']);
        }

        return $realRoles;
    }

    // -------------------------------------- Other Functions -------------------------------------- //

    // Verify Email Address
    public function verifyEmail() {
        helper('keycloak');
        $keycloak = initKeycloak();
        if (!isset($keycloak->updateUser(['id' => $this->attributes['oauth_id'],'emailVerified' => false])['errorMessage'])) { return false; }
        return boolval(!isset($keycloak->sendVerifyEmail(['id' => $this->attributes['oauth_id']])['errorMessage']));
    }

    // -------------------------------------- User Connection -------------------------------------- //

    // ------------------- Get Connections ------------------- //

    // Get Github
    public function getGithub() {
        helper('keycloak');
        $keycloak = initKeycloak();

        foreach ($keycloak->getSocialLogins(['id' => $this->attributes['oauth_id']]) as $login) {
            if ($login['identityProvider'] == 'github') {
                return [
                    'id' => $login['userId'],
                    'username' => $login['userName'],
                ];
            }
        }

        return false;        
    }

    // Get Discord
    public function getDiscord() {
        helper('keycloak');
        $keycloak = initKeycloak();

        foreach ($keycloak->getSocialLogins(['id' => $this->attributes['oauth_id']]) as $login) {
            if ($login['identityProvider'] == 'discord') {
                return [
                    'id' => $login['userId'],
                    'username' => $login['userName'],
                ];
            }
        }

        return false;  
    }

    // ------------------- Set Connections ------------------- //

    // Set Github
    public function setGithub(array $data) {
        helper('keycloak');
        $keycloak = initKeycloak();

        $keycloak->addSocialLogin(['id' => $this->attributes['oauth_id'], 'providerId' => 'github', 'userId' => $data['id'], 'userName' => $data['login']]);
    }

    // Set Discord
    public function setDiscord(array $data) {
        helper('keycloak');
        $keycloak = initKeycloak();

        $keycloak->addSocialLogin(['id' => $this->attributes['oauth_id'], 'providerId' => 'discord', 'userId' => $data['id'], 'userName' => $data['username']]);
    }

    // ------------------- Unset Connections ------------------- //

    // Unset Github
    public function unsetGithub() {
        helper('keycloak');
        $keycloak = initKeycloak();

        $keycloak->removeSocialLogin(['id' => $this->attributes['oauth_id'], 'providerId' => 'github']);
    }

    // Unset Discord
    public function unsetDiscord() {
        helper('keycloak');
        $keycloak = initKeycloak();

        $keycloak->removeSocialLogin(['id' => $this->attributes['oauth_id'], 'providerId' => 'discord']);
    }

    // ------------------- Check Connections ------------------- //

    // Check Github
    public function hasGithub() : bool {
        helper('keycloak');
        $keycloak = initKeycloak();

        foreach ($keycloak->getSocialLogins(['id' => $this->attributes['oauth_id']]) as $login) {
            if ($login['identityProvider'] == 'github') {
                return true;
            }
        }

        return false;
    }

    // Check Discord
    public function hasDiscord() : bool {
        helper('keycloak');
        $keycloak = initKeycloak();

        foreach ($keycloak->getSocialLogins(['id' => $this->attributes['oauth_id']]) as $login) {
            if ($login['identityProvider'] == 'discord') {
                return true;
            }
        }

        return false;
    }
}