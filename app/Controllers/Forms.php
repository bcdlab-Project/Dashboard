<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Forms extends BaseController
{
    public function getIndex() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Forms Evaluations';
        $data['pageMargin'] = true;
        $data['view'] = 'overview';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('forms/header')
            . view('forms/overview')
            . view('templates/footer');
    }

    public function getParticipation() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Participations Forms';
        $data['pageMargin'] = true;
        $data['view'] = 'participation';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('forms/header')
            . view('forms/participation')
            . view('templates/footer');
    }

    public function getProject() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Projects Forms';
        $data['pageMargin'] = true;
        $data['view'] = 'project';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('forms/header')
            . view('forms/project')
            . view('templates/footer');
    }

    public function getCollaboration() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }

        $data['title'] = 'Collaboration Forms';
        $data['pageMargin'] = true;
        $data['view'] = 'collaboration';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('forms/header')
            . view('forms/collaboration')
            . view('templates/footer');
    }

    public function getOther() {
        helper('permissions');
        if (!admin_Permission()) { return redirect()->to('/'); }
        
        $data['title'] = 'Other Forms';
        $data['pageMargin'] = true;
        $data['view'] = 'other';
        $data['hasNotification'] = true;

        return view('templates/header', $data)
            . view('templates/notificationMenu')
            . view('forms/header')
            . view('forms/other')
            . view('templates/footer');
    }
}