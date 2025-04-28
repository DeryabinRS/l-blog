@extends('backend.layouts.auth-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')

    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-secondary">Вход</h2>
        </div>
        <form action="{{ route('login_handler') }}" method="POST">

            <x-form-alerts></x-form-alerts>
            @csrf

            <div class="input-group custom mb-1">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            <div class="pb-2">
                @error('email')
                    <small class="text-danger ml-1 mb-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="input-group custom mt-2 mb-2">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="**********">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            <div class="pb-3">
                @error('password')
                    <small class="text-danger ml-1 mb-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="row pb-30">
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Запомнить меня</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="forgot-password">
                        <a href="{{ route('forgot') }}">Забыли пароль?</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Отправить">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
