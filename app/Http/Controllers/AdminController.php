<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use SawaStacks\Utils\Kropify;


class AdminController extends Controller
{
    public function adminDashboard(Request $request)
    {
        $data = [
            'pageTitle' => 'Admin Dashboard',
        ];
        return view('backend.pages.dashboard', $data);
    }

    public function logoutHandler(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login')->with('info', 'Вы вышли из панели администратора');
    }

    public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'Профиль',
        ];

        return view('backend.pages.profile', $data);
    }

    public function updateProfilePicture(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $path = 'images/users/';
        $file = $request->file('profilePictureFile');
        $old_picture = $user->getAttributes()['picture'];
        $filename = 'IMG_'.uniqid().'.png';

        $upload = Kropify::getFile($file, $filename)->maxWoH(255)->save($path);

        if ($upload) {
            if ( $old_picture != null && File::exists(public_path($path.$old_picture)) ) {
                File::delete(public_path($path.$old_picture));
            }
            $user->update(['picture' => $filename]);

            return response()->json(['status' => 1, 'message' => 'Изображение пользователя обновлено']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Ошибка обновления изображения']);
        }


    }
}
