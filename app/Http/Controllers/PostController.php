<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostController extends Controller
{
    public function allPosts()
    {

    }

    public function addPost(Request $request)
    {
        $post_categories = PostCategory::all();

        $data = [
            'pageTitle' => 'Добавить событие',
            'post_categories' => $post_categories,
        ];

        return view('backend.pages.posts.add_post', $data);
    }

    public function createPost()
    {

    }
}
