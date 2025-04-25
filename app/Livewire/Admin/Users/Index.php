<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 25;

    public $search = null;
    public $status = null;
    public $sort = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    protected $listeners = [
        'deletePostAction',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::search(trim($this->search))
                ->when($this->status, function($query) {
                    $query->where('status', $this->status);
                })
                ->when($this->sort, function($query) {
                    $query->orderBy('id', $this->sort);
                })
                ->paginate($this->perPage),
        ]);
    }
}
