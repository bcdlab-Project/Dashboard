<?php

function loggedIn_Permission()
{
    $session = session();
    if ($session->has('loggedIn')) {
        return $session->get('loggedIn');
    } else {
        return false;
    }
}