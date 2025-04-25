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
                <a href="{{ route('admin.posts') }}" class="btn btn-secondary">
                    <i class="icon-copy bi bi-list"></i> Список событий
                </a>
            </div>
        </div>
    </div>

    <form
{{--        action="{{ route('admin.update_post', [ 'user_id' => $user->id ]) }}"--}}
        method="POST"
        autocomplete="off"
        enctype="multipart/form-data"
        id="updatePostForm"
    >
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-box mb-2 p-4">
                    <div class="form-group">
                        <label for="">Статус</label>
                        <select class="custom-select col-12" name="post_category">
                            @foreach($user_statuses as $item)
                                <option value="{{ $item }}" {{ $user->id == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('post_category')
                        <small class="text-danger error-text post_category_error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block mt-2 mb-3">
            <button type="submit" class="btn badge-primary">Сохранить</button>
        </div>
    </form>
@endsection

