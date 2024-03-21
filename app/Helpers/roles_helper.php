<?php


function getRoleInfo(int $roleId = null) : array {
    $UserRolesModel = model('UserRolesModel');
    if ($roleId == null) {
        $session = session();
        $roleId = $session->get('user_data')['role'];
    }
    $role = $UserRolesModel->where('id',$roleId)->first();

    return $role;
}