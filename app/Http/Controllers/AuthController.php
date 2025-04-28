<?php

namespace App\Http\Controllers;

use App\UserStatus;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;
use App\Rules\ReCaptcha;

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
            if (!auth()->user()->email_verified_at) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')
                    ->withInput()
                    ->with('fail', 'Аккаунт не подвтержден. На Ваш Email при РЕГИСТРАЦИИ было выслано сообщение с условиями подтвержения аккаунта. Пожалуйста подтвердите свой аккаунт.');
            }

            if (auth()->user()->status === UserStatus::BLOCKED) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->withInput()->with('fail', 'Пользователь заблокирован');
            }

            if (auth()->user()->status === UserStatus::PENDING) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->withInput()->with('fail', 'Аккаунт находится в процессе проверки');
            }

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->withInput()->with('fail', 'Не верный логин или пароль');
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

        $actionLink = route('reset_password_form', ['token' => $token]);

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
            return redirect()->route('forgot')->with('success', 'На Ваш Email направлено письмо с восстановлением пароля');
        } else {
            return redirect()->route('forgot')->with('fail', 'Ошибка восстановления пароля');
        }
    }

    public function resetPasswordForm(Request $request, $token = null)
    {
        $isTokenExists = DB::table('password_reset_tokens')
                            ->where('token', $token)
                            ->first();

        if (!$isTokenExists) {
            return redirect()->route('forgot')->with('fail', 'Не правильная ссылка для восстановления пароля');
        } else {
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $isTokenExists->created_at)
                            ->diffInMinutes(Carbon::now());

            if($diffMins > 15){
                return redirect()
                    ->route('forgot')
                    ->with('fail', 'Срок ссылки для смены пароля истек. Пожалуйста повторите процедуру смены пароля');
            }

            $data = [
                'token' => $token,
                'pageTitle' => 'Восстановление пароля',
            ];

            return view('backend.pages.auth.reset', $data);
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'required',
        ], [
            'new_password.required' => 'Поле должно быть заполнено',
            'new_password.same' => 'Пароли не совпадают',
            'new_password.min' => 'Пароль не может содержать менее 6 символов',
            'new_password_confirmation.required' => 'Поле должно быть заполнено',
        ]);

        $dbToken = DB::table('password_reset_tokens')
                    ->where('token', $request->token)->first();

        $user = User::where('email', $dbToken->email)->first();

        User::where('email', $dbToken->email)->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Send notificatio email to this user email address that contain new password
        $data = array(
            'user' => $user,
            'password' => $request->new_password,
            'title' => 'Восстановление пароля',
        );

        $mail_body = view('email-templates.user-password-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->firstname . ' ' . $user->lastname,
            'subject' => 'Изменение пароля',
            'body' => $mail_body,
        );

        if(CMail::send($mailConfig)) {
            DB::table('password_reset_tokens')->where([
                'email' => $dbToken->email,
                'token' => $dbToken->token,
            ])->delete();

            return redirect()->route('login')->with('success', 'Ваш пароль был успешно изменен');
        } else {
            return redirect()
                ->route('reset_password_form', [ 'token' => $dbToken->token ])
                ->with('fail', 'Ошибка изменения пароля. Попробуйте позже');
        }
    }

    public function registerForm()
    {
        return view('backend.pages.auth.register');
    }

    public function registerHandler(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
//            'g-recaptcha-response' => [new ReCaptcha],
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $saved = $user->save();

        if ($saved) {
            $actionLink = route('validate_email', ['id' => $user->id, 'token' => $user->password]);

            $data = array(
                'user' => $user,
                'title' => 'Регистрация нового пользователя',
                'actionLink' => $actionLink,
            );

            $mail_body = view('email-templates.register-template', $data)->render();

            $mailConfig = array(
                'recipient_address' => $user->email,
                'recipient_name' => $user->firstname . ' ' . $user->lastname,
                'subject' => 'Регистрация нового пользователя',
                'body' => $mail_body,
            );

            if (CMail::send($mailConfig)) {
                return redirect()->route('login')->with('success', 'На Ваш Email направлено письмо с условиями активации аккаунта');
            } else {
                return redirect()->route('login')->with('fail', 'Ошибка отправки сообщения');
            }
        } else {
            return redirect()->route('login')->with('fail', 'Ошибка регистрации пользователя');
        }
    }

    public function validateEmail(Request $request, $id = null, $token = null)
    {
        $user = User::findOrFail($id);

        if ($user) {
            if(!$user->email_verified_at) {
                if ($user->password == $token) {
                    $user->email_verified_at = now()->timestamp;
                    $saved = $user->save();
                    if ($saved) {
                        return redirect()->route('login')->with('success', 'Ваш аккаунт успешно подтвержден');
                    } else {
                        return redirect()->route('login')->with('fail', 'Ошибка подтверждения аккаунта');
                    }
                } else {
                    return redirect()->route('login')->with('fail', 'Ошибка подтверждения аккаунта');
                }
            } else {
                return redirect()->route('login')->with('fail', 'Аккаунт уже подтвержден');
            }
        } else {
            return redirect()->route('login')->with('fail', 'Ошибка подтверждения аккаунта');
        }
    }
}
