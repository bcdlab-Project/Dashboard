<?php

function initKeycloak() {
    $config = config('KeyCloakIntegration');

    return \Keycloak\Admin\KeycloakClient::factory([
        'realm' => $config->realm,
        'grant_type' => 'client_credentials',
        'client_id' => $config->client_id,
        'client_secret' => $config->client_secret,
        'baseUri' => $config->baseUri,
    ]);
}