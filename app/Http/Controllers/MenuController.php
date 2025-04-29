<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menuItems()
    {
        return view('backend.pages.menu.index');
    }

    public function addMenuItem()
    {

    }
}
