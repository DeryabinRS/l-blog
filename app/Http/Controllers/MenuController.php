<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menuItems()
    {
        return view('backend.pages.menu.index', [ 'pageTitle' => 'Список меню' ]);
    }

    public function addMenuItem()
    {
        $menuItems = Menu::all();
        $pages = Page::all();

        return view('backend.pages.menu.add', [
            'pageTitle' => 'Создать пункт меню',
            'menuItems' => $menuItems,
            'pages' => $pages,
        ]);
    }

    public function createMenuItem(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);

        $post = new Menu();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->parent_id = $request->parent_id;
        $post->visibility = $request->visibility;

        $saved = $post->save();

        if ($saved) {
            return redirect()->route('admin.menu_items')->with('success', 'Новая пункт меню успешно создан');
        } else {
            return redirect()->route('admin.menu_items')->with('fail', 'Ошибка добавления данных');
        }
    }

    public function editMenuItem()
    {

    }

    public function updateMenuItem()
    {

    }
}
