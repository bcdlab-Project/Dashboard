<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Form_approvals extends BaseController
{
    public function getIndex() {
        $data['title'] = 'Form Approvals';
        $data['pageMargin'] = true;
        $data['view'] = 'form_approvals';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('dashboard/header')
            //. view('dashboard/form_approvals')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }

}