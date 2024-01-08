<?php

namespace App\Controllers;

class Participate extends BaseController
{
    public function getIndex() {
        $data['title'] = 'Participate';
        $data['centerContent'] = true;

        return view('templates/header', $data)
            . view('participate')
            . view('templates/footer');
    }
}