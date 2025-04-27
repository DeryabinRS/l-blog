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
        ];

        return view('backend.pages.users.edit', $data);
    }

    public function updateUserAdmin(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $request->validate([
            'status' => 'required',
        ]);

        $user->status = $request->status;

        if ($request->email_verified_at) {
            $user->email_verified_at = now()->timestamp;
        } else {
            $user->email_verified_at = null;
        }

        $saved = $user->save();

        if ($saved) {
            return redirect()->route('admin.edit_user', [ 'id' => $user->id ])->with('success', 'Данные успешно обновлены');
        } else {
            return redirect()->route('admin.edit_user', [ 'id' => $user->id ])->with('fail', 'Ошибка обновления данных');
        }
    }
}
