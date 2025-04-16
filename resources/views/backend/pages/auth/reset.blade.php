@extends('backend.layouts.auth-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Восстановление пароля</h2>
        </div>
        <h6 class="mb-20">Введите новый пароль</h6>
        <form>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" placeholder="Новый пароль">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" placeholder="Повторите пароль">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
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
