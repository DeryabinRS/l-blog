<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 25;

    public $search = null;
    public $visibility = null;
    public $sort = 'desc';
    public $state_visibility;

    protected $queryString = [
        'search' => ['except' => ''],
        'visibility' => ['except' => ''],
    ];

    protected $listeners = [
        'deleteAction',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedVisibility()
    {
        $this->resetPage();
        $this->state_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function mount()
    {
        $this->state_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function deleteRecord($id)
    {
        $this->dispatch('deleteRecord', ['id' => $id]);
    }

    public function deleteAction($id)
    {
        $page = Page::findOrFail($id);

        $delete = $page->delete();
        if ($delete) {
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно удалены']);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка удаления данных']);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.index', [
            'pages' => Page::search(trim($this->search))
                ->when($this->visibility, function($query) {
                    $query->where('visibility', $this->state_visibility);
                })
                ->when($this->sort, function($query) {
                    $query->orderBy('id', $this->sort);
                })
                ->paginate($this->perPage),
        ]);
    }
}
