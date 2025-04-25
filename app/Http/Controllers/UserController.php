<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUsersAdmin()
    {
        $data = [
            'pageTitle' => 'Пользователи',
        ];

        return view('backend.pages.users.index', $data);
    }

    public function editUserAdmin(Request $request, $id = null)
    {
        $user = User::findOrFail($id);

        $data = [
            'pageTitle' => 'Изменить параметры пользователя',
            'user' => $user,
            'user_statuses' => [
                'active',
                'pending',
                'blocked'
            ],
        ];

        return view('backend.pages.users.edit', $data);
    }
}
