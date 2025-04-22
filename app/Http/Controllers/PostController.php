<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function allPosts(Request $request)
    {
        $data = [
            'pageTitle' => 'События',
        ];
        return view('backend.pages.posts.store', $data);
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
            $thumbnail_path = $path.'thumb/';

            $file = $request->file('featured_image');
            $fileName = $file->getClientOriginalName();
            $newFileName = time().'_'.$fileName;

            $upload = $file->move($path, $newFileName);
            if ($upload) {
                /** Resize image */
                if (!File::isDirectory($thumbnail_path)) {
                    File::makeDirectory($thumbnail_path, 0777, true, true);
                }

                // Resize
                $img = Image::make($path.$newFileName);

//                $img->resize(600, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                })->save($path.$newFileName);

                $img->fit(650, 650)->save($path.$newFileName);
                // Thumbnail
                $img->fit(200, 200)->save($thumbnail_path.'thumb_'.$newFileName);

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

    public function editPost(Request $request, $id = null)
    {
        $post = Post::findOrFail($id);
        $post_categories = PostCategory::all();

        $data = [
            'pageTitle' => 'Изменить событие',
            'post' => $post,
            'post_categories' => $post_categories,
        ];

        return view('backend.pages.posts.edit_post', $data);
    }

    public function updatePost(Request $request, $id = null)
    {

    }
}
