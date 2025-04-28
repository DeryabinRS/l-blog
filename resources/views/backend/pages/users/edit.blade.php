@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>{{ $pageTitle }}</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $pageTitle }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                    <i class="icon-copy bi bi-list"></i> Список пользователей
                </a>
            </div>
        </div>
    </div>

    <form
        action="{{ route('admin.update_user', [ 'user_id' => $user->id ]) }}"
        method="POST"
        autocomplete="off"
        enctype="multipart/form-data"
        id="updateUserForm"
    >
        @csrf
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card card-box p-4">
                    <div><img class="img-fluid img-thumbnail" src="{{ $user->picture }}" alt="" /></div>
                    <div class="my-2">
                        {{ $user->lastname.' '.$user->firstname.' '.$user->middlename }}
                    </div>
                    <div class="mb-3">
                        {{ $user->email }}
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mb-4">
                <div class="card card-box mb-2 p-4">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            name="email_verified_at"
                            id="email_verified_at"
                            type="checkbox"
                            {{(bool)$user->email_verified_at ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="email_verified_at">Подтверждение email</label>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Статус</label>
                        <select class="custom-select col-12" name="status">
                            @foreach(getUserStatuses() as $item)
                                <option value="{{ $item['value'] }}" {{ $user->status->value == $item['value'] ? 'selected' : '' }}>{{ $item['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Роль</label>
                        <select class="custom-select col-12" name="role">
                            @foreach(getUserRoles() as $item)
                                <option value="{{ $item['value'] }}" {{ $user->role == $item['value'] ? 'selected' : '' }}>{{ $item['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-block mt-1">
                        <button type="submit" class="btn badge-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

