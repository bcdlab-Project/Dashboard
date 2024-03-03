<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!loggedIn_Permission()) {
            return redirect()->to('/authentication/login'); //give error
        }
        
        $data['title'] = 'Profile | bcdlab-Project';
        $data['pageMargin'] = true;
        $data['hasNotification'] = true;
        $data['view'] = 'profile';

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('profile')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }
}