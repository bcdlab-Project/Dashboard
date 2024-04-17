<?php

function loggedIn_Permission()
{
    $session = session();
    if ($session->has('loggedIn')) {
        return $session->get('loggedIn');
    }
    return false;
}

function own_Permission($id)
{
    $session = session();
    if ($session->has('user_data')) {
        if ($session->get('user_data')['id'] == $id) {
            return true;
        }
    }
    return false;
}

function admin_Permission()
{
    $session = session();
    if ($session->has('user_data')) {
        if (in_array('administrator', $session->get('user_data')['roles'])) {
            return true;
        }
    }
    return false;
}