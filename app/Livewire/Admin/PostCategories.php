<?php

namespace App\Livewire\Admin;

use App\Models\PostCategory;
use Livewire\Component;

class PostCategories extends Component
{
    public $isUpdatePostCategoryMode = false;
    public $category_id, $category_name, $category_description;

    protected $listeners = [
        'deletePostCategory',
    ];

    public function render()
    {
        return view('livewire.admin.post-categories', [
            'post_categories' => PostCategory::orderBy('order', 'asc')->get(),
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
    }

    public function createPostCategoryForm()
    {
        $this->category_id = null;
        $this->category_name = null;
        $this->category_description = null;
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

        $deleted = $post_category->delete();

        if ($deleted) {
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно удалены']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка удаления данных']);
        }
    }

}
