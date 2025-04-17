<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
}
