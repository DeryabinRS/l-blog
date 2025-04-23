<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use App\Models\PostCategory;
use Illuminate\Support\Facades\File;

class Store extends Component
{
    use WithPagination;

    public $perPage = 25;

    public $search = null;
    public $author = null;
    public $postCategory = null;
    public $visibility = null;
    public $sort = 'desc';
    public $post_visibility;

    protected $queryString = [
        'search' => ['except' => ''],
        'author' => ['except' => ''],
        'postCategory' => ['except' => ''],
        'visibility' => ['except' => ''],
    ];

    protected $listeners = [
        'deletePostAction',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedAuthor()
    {
        $this->resetPage();
    }
    public function updatedPostCategory()
    {
        $this->resetPage();
    }
    public function updatedVisibility()
    {
        $this->resetPage();
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function mount()
    {
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function deletePost($id)
    {
        $this->dispatch('deletePost', ['id' => $id]);
    }

    public function deletePostAction($id)
    {
        $post = Post::findOrFail($id);
        $path = 'images/posts/';
        $thumbnailPath = $path.'thumb/';
        $oldFeaturedImage = $post->featured_image;

        if ($oldFeaturedImage != '' && File::exists(public_path($path.$oldFeaturedImage))) {
            File::delete(public_path($path.$oldFeaturedImage));
            if (File::exists(public_path($thumbnailPath.'thumb_'.$oldFeaturedImage))) {
                File::delete(public_path($thumbnailPath.'thumb_'.$oldFeaturedImage));
            }
        }

        $delete = $post->delete();
        if ($delete) {
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно удалены']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка удаления данных']);
        }
    }

    public function render()
    {
        return view('livewire.admin.posts.store', [
            'posts' => Post::search(trim($this->search))
                ->when($this->author, function($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->postCategory, function($query) {
                    $query->where('post_category', $this->postCategory);
                })
                ->when($this->visibility, function($query) {
                    $query->where('visibility', $this->post_visibility);
                })
                ->when($this->sort, function($query) {
                    $query->orderBy('id', $this->sort);
                })
                ->paginate($this->perPage),
        ]);
    }
}
