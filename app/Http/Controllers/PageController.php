<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function allPages()
    {
        return view('backend.pages.pages.index', [
            'pageTitle' => 'Страницы',
        ]);
    }

    public function addPage()
    {
        return view('backend.pages.pages.add', [
            'pageTitle' => 'Страницы',
        ]);
    }

    public function createPage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->{'content'};
        $page->slug = Str::slug($request->title);
        $page->visibility = $request->visibility;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;

        $saved = $page->save();

        if ($saved) {
            return redirect()->route('admin.pages')->with('success', 'Новая страница успешно создана');
        } else {
            return redirect()->route('admin.pages')->with('fail', 'Ошибка добавления данных');
        }
    }

    public function editPage(Request $request, $id = null)
    {
        $page = Page::findOrFail($id);

        return view('backend.pages.pages.edit', [
            'pageTitle' => 'Редактировать',
            'page' => $page,
        ]);
    }

    public function updatePage(Request $request)
    {
        $page = Page::findOrFail($request->id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $page->title = $request->title;
        $page->content = $request->{'content'};
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->visibility = $request->visibility;

        $saved = $page->save();

        if ($saved) {
            return redirect()->route('admin.edit_page', [ 'id' => $page->id ])->with('success', 'Данные успешно обновлены');
        } else {
            return redirect()->route('admin.edit_page', [ 'id' => $page->id ])->with('fail', 'Ошибка обновления данных');
        }
    }
}
