<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Forms extends BaseController
{
    public function getIndex() {
        helper('permissions');

        if (!admin_Permission()) {
            return redirect()->to('/login');
        }

        $data['title'] = 'Form Approvals';
        $data['pageMargin'] = true;
        $data['view'] = 'form_approvals';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')

            //. view('dashboard/form_approvals')
            . view('templates/footer');
            
    }

}