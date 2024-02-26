<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function getIndex() {
        $data['title'] = 'bcdlab-Project';
        $data['pageMargin'] = true;

        return view('templates/header', $data)
            . view('main')
            . view('templates/footer') 
            . view('templates/sidemenu');
    }
}