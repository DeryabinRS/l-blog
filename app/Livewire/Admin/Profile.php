<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\CMail;

class Profile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $firstname, $lastname, $middlename, $email;

    public $current_password, $new_password, $new_password_confirmation;

    protected $listeners = [
        'updateProfile' => '$refresh',
    ];

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
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка обновления данных']);
        }
    }

    public function updatePassword()
    {
        $user = User::findOrFail(auth()->id());

        $this->validate([
            'current_password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('Не верно введен текущий пароль'));
                    }
                }
            ],
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Введите текущий пароль',
            'new_password.required' => 'Введите новый пароль',
            'new_password.confirmed' => 'Пароли не совпадают',
        ]);

        $updated = $user->update(['password' => Hash::make($this->new_password)]);

        if ($updated) {
            $data = array(
                'user' => $user,
                'new_password' => $this->new_password,
            );
            $mail_body = view('email-templates.password-change-template', $data)->render();
            $mail_config = array(
                'recipient_address' => $user->email,
                'recipient_name' => $user->firstname,
                'subject' => 'Изменение пароля',
                'body' => $mail_body,
            );

            CMail::send($mail_config);

            auth()->logout();
            Session::flash('info', 'Ваш парольбыл изменен. Пожалуйста войдите в приложение с новым паролем');
            $this->redirectRoute('admin.login');
        } else {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Ошибка обновления данных']);
        }
    }
}
