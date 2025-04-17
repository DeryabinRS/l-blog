<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;

class Profile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $firstname, $lastname, $middlename, $email;

    public function selectTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        $this->tab = Request('tab') ?? $this->tabname;

        $user = User::findOrFail(auth()->id());
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->middlename = $user->middlename;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => User::findOrFail(auth()->id()),
        ]);
    }

    public function updatePersonalDetails()
    {
        $user = User::findOrFail(auth()->id());

        $this->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
//            'email' => 'required|string|email|unique:users,email,'.$user->id(),
        ], [
            'firstname.required' => 'Введите значение',
            'lastname.required' => 'Введите значение',
        ]);

        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->middlename = $this->middlename;

        $updated = $user->save();
        sleep(0.5);

        if($updated) {
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Данные успешно обновлены']);
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка. Данные не обновлены']);
        }
    }
}
