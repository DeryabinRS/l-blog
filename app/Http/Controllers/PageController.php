<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function allPages()
    {
        return view('backend.pages.pages.index', [
            'pageTitle' => 'Страницы',
        ]);
    }

    public function editPage()
    {

    }

    public function updatePage()
    {

    }
}
