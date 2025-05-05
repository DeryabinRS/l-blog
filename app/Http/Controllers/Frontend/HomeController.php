<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isArray;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()
            ->where('visibility', 1)
            ->take(4)
            ->get();

        $prepareDataPosts = $posts->map(function($post) {
            $user = User::findOrFail($post->author_id)->first();
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => Str::words(strip_tags($post->content), 20, '...'),
                'featured_image' => $post->featured_image,
                'author' => $user->firstname . ' ' . $user->lastname,
            ];
        });

        $data = [
            'firstPost' => $prepareDataPosts->shift(),
            'posts' => $prepareDataPosts,
        ];

        return view('frontend.pages.home', $data);
    }
}
