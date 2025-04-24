@extends('backend.layouts.auth-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-secondary">Восстановление пароля</h2>
        </div>
        <h6 class="mb-20">Введите новый пароль</h6>
        <form action="{{ route('admin.reset_password_handler', ['token' => $token]) }}" method="POST">

            <x-form-alerts></x-form-alerts>
            @csrf

            <div class="input-group custom mb-1">
                <input
                    type="password"
                    class="form-control form-control-lg"
                    placeholder="Новый пароль"
                    name="new_password"
                >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            <div class="mb-4">
                @error('new_password')
                    <small class="text-danger ml-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="input-group custom mb-1">
                <input
                    type="password"
                    class="form-control form-control-lg"
                    placeholder="Повторите пароль"
                    name="new_password_confirmation"
                >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            <div class="mb-4">
                @error('new_password_confirmation')
                    <small class="text-danger ml-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Отправить">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
