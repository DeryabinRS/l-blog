@extends('backend.layouts.auth-layout')
@push('head_scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Регистрация</h2>
        </div>
        <form action="{{ route('admin.register_handler') }}" method="POST">

            <x-form-alerts></x-form-alerts>
            @csrf

            <div class="input-group custom mb-1">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    name="firstname"
                    placeholder="Имя"
                    value="{{ old('firstname') }}"
                >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            <div class="pb-2">
                @error('firstname')
                <small class="text-danger ml-1 mb-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="input-group custom mb-1">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    name="lastname"
                    placeholder="Фамилия"
                    value="{{ old('lastname') }}"
                >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            <div class="pb-2">
                @error('lastname')
                <small class="text-danger ml-1 mb-2">{{ $message }}</small>
                @enderror
            </div>

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
            <div class="input-group custom mb-2">
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
            <div class="mb-4">
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                @if($errors->has('g-recaptcha-response'))
                    <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                @endif
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
