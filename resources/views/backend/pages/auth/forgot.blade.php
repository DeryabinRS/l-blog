@extends('backend.layouts.auth-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-secondary">Восстановление пароля</h2>
        </div>
        <p>
            Введите Ваш Email для восстановления пароля
        </p>
        <form action="{{ route('send_password_reset_link') }}" method="POST">

            <x-form-alerts></x-form-alerts>
            @csrf

            <div class="input-group custom mb-1">
                <input type="text" class="form-control form-control-lg" placeholder="Email" name="email" value="{{ old('email') }}">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="mb-4">
                @error('email')
                    <small class="text-danger ml-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="row align-items-center">
                <div class="col-5">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Отправить">
                    </div>
                </div>
                <div class="col-2">
                    <div class="font-16 weight-600 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">
                        ИЛИ
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}">Вход</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
