<?php

namespace App\Livewire\Admin;

use App\Models\PostCategory;
use Livewire\Component;
use Livewire\WithPagination;

class PostCategories extends Component
{
    use WithPagination;

    public $isUpdatePostCategoryMode = false;
    public $category_id, $category_name, $category_description, $icon;

    public $perPage = 25;

    protected $listeners = [
        'deletePostCategory',
    ];

    public function render()
    {
        return view('livewire.admin.post-categories', [
            'post_categories' => PostCategory::orderBy('order', 'asc')->paginate($this->perPage, ['*'], 'pc_page'),
        ]);
    }

    public function showPostCategoryModalForm()
    {
        $this->resetErrorBag();
        $this->dispatch('showPostCategoryModalForm');
    }

    public function hidePostCategoryModalForm()
    {
        $this->dispatch('hidePostCategoryModalForm');
        $this->isUpdatePostCategoryMode = false;
        $this->category_id = null;
        $this->category_name = null;
        $this->category_description = null;
        $this->icon = null;
    }

    public function createPostCategoryForm()
    {
        $this->category_id = null;
        $this->category_name = null;
        $this->category_description = null;
        $this->icon = null;
        $this->isUpdatePostCategoryMode = false;
        $this->showPostCategoryModalForm();
    }

    public function createPostCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:post_categories,name',
        ], [
            'category_name.required' => 'Введите название категории',
            'category_name.unique' => 'Это название уже существует',
        ]);

        $post_category = new PostCategory();
        $post_category->name = $this->category_name;
        $post_category->description = $this->category_description;
        $post_category->icon = $this->icon;
        $saved = $post_category->save();

        if ($saved) {
            $this->hidePostCategoryModalForm();
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно сохранены']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка добавления данных']);
        }
    }

    public function editPostCategoryForm($id)
    {
        $post_category = PostCategory::findOrFail($id);
        $this->category_id = $post_category->id;
        $this->icon = $post_category->icon;
        $this->category_name = $post_category->name;
        $this->category_description = $post_category->description;
        $this->isUpdatePostCategoryMode = true;
        $this->showPostCategoryModalForm();
    }

    public function updatePostCategory()
    {
        $post_category = PostCategory::findOrFail($this->category_id);

        $this->validate([
            'category_name' => 'required|unique:post_categories,name,'.$post_category->id,
        ], [
            'category_name.required' => 'Введите название категории',
            'category_name.unique' => 'Это название уже существует',
        ]);

        $post_category->name = $this->category_name;
        $post_category->icon = $this->icon;
        $post_category->description = $this->category_description;
        $saved = $post_category->save();

        if ($saved) {
            $this->hidePostCategoryModalForm();
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно сохранены']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка добавления данных']);
        }
    }

    public function deletePostCategoryForm($id)
    {
        $this->dispatch('deletePostCategoryForm', ['id' => $id]);
    }

    public function deletePostCategory($id)
    {
        $post_category = PostCategory::findOrFail($id);
        $countPosts = $post_category->posts()->count();
        if ($countPosts > 0) {
            $this->dispatch('showToast', [
                'type' => 'error',
                'text' => 'Данная категория не может быть удалена т.к. содержит ('.$countPosts.') связанные записи.',
                'timer' => 5000,
                'toast' => ' ',
                'position' => 'center',
            ]);
        } else {
            $deleted = $post_category->delete();

            if ($deleted) {
                $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно удалены']);
            } else {
                $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка удаления данных']);
            }
        }
    }
}
