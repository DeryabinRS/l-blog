<?php

namespace App\Http\Controllers;

use App\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Login',
        ];
        return view('backend.pages.auth.login', $data);
    }

    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Forgot Password',
        ];
        return view('backend.pages.auth.forgot', $data);
    }

    public function loginHandler(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        $creds = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if(Auth::attempt($creds)) {
            if (auth()->user()->status === UserStatus::INACTIVE) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->withInput()->with('fail', 'Пользователь не активен');
            }

            if (auth()->user()->status === UserStatus::PENDING) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->withInput()->with('fail', 'Аккаунт находится в процессе проверки');
            }

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withInput()->with('fail', 'Не верный логин или пароль');
        }
    }

    public function sendPasswordResetLink(Request $request)
    {
        // Validate the form
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Поле Email не должно быть пустое',
            'email.email' => 'Email не валиден',
            'email.exists' => 'Пользователь с таким email не найден',
        ]);

        $user = User::where('email', $request->email)->first();

        $token = base64_encode(Str::random(64));

        $oldToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        }

        $actionLink = route('admin.reset_password_form', ['token' => $token]);

        $data = array(
            'actionLink' => $actionLink,
            'user' => $user,
        );

        $mail_body = view('email-templates.forgot-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->firstname . ' ' . $user->lastname,
            'subject' => 'Reset Password',
            'body' => $mail_body,
        );

        if (CMail::send($mailConfig)) {
            return redirect()->route('admin.forgot')->with('success', 'На Ваш Email направлено письмо с восстановлением пароля');
        } else {
            return redirect()->route('admin.forgot')->with('fail', 'Ошибка восстановления пароля');
        }
    }

    public function resetForm(Request $request, $token = null)
    {
        $isTokenExists = DB::table('password_reset_tokens')
                            ->where('token', $token)
                            ->first();

        if (!$isTokenExists) {
            return redirect()->route('admin.forgot')->with('fail', 'Не правильная ссылка для восстановления пароля');
        } else {
            $data = [
                'token' => $token,
                'pageTitle' => 'Восстановление пароля',
            ];

            return view('backend.pages.auth.reset', $data);
        }
    }
}
