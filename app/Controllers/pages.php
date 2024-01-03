<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function getIndex(): string
    {
        return view('welcome_message');
    }

    public function view($page = 'test') {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException('get:' . $page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['centerContent'] = false;

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}