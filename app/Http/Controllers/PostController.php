<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function allPosts()
    {
        return view('backend.pages.posts.store');
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

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'post_category' => 'required|exists:post_categories,id',
            'content' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'images/posts/';
            $file = $request->file('featured_image');
            $fileName = $file->getClientOriginalName();
            $newFileName = time().'_'.$fileName;

            $upload = $file->move($path, $newFileName);
            if ($upload) {
                /** Resize image */

                $thumbnail_path = $path.'thumbnail/';
                if (!File::isDirectory($thumbnail_path)) {
                    File::makeDirectory($thumbnail_path, 0777, true, true);
                }

                // Resize
                $img = Image::make($path.$newFileName);
                $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$newFileName);
                // Thumbnail
                $img->fit(250, 250)->save($thumbnail_path.'thumb_'.$newFileName);

                $post = new Post();
                $post->author_id = auth()->id();
                $post->post_category = $request->post_category;
                $post->title = $request->title;
                $post->content = $request->{'content'};
                $post->featured_image = $newFileName;
                $post->tags = $request->tags;
                $post->meta_keywords = $request->meta_keywords;
                $post->meta_description = $request->meta_description;
                $post->visibility = $request->visibility;

                $saved = $post->save();

                if ($saved) {
                    return redirect()->route('admin.posts')->with('success', 'Новый пост успешно создан');
                } else {
                    return redirect()->route('admin.posts')->with('fail', 'Ошибка добавления данных');
                }
            } else {
                return redirect()->route('admin.posts')->with('fail', 'Ошибка добавления файла');
            }
        }
    }
}
