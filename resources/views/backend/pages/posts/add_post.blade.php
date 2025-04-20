@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Добавить событие</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Добавить событие
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-secondary" href="{{ route('admin.posts') }}">
                    Список событий
                </a>
            </div>
        </div>
    </div>

    <form
        action="{{ route('admin.create_post') }}"
        method="POST"
        autocomplete="off"
        enctype="multipart/form-data"
        id="addPostForm"
    >
    @csrf
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-box mb-2 p-4">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input type="text" class="form-control" name="title" placeholder="Введите название">
                        @error('title')
                            <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Категория события</label>
                        <select class="custom-select col-12" name="post_category">
                            @foreach($post_categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('post_category')
                            <small class="text-danger error-text post_category_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Изображение:</label>
                        <div class="d-block mb-3" style="max-width: 250px">
                            <img src="" alt="" class="img-thumbnail img-fluid" id="featured_image_preview">
                        </div>
                        <input type="file" onchange="loadFile(event)" id="featured_image" name="featured_image" class="form-control-file form-control height-auto">
                        @error('featured_image')
                            <small class="text-danger error-text featured_image_error">{{ $message }}</small>
                        @enderror
                        <script>
                            const loadFile = function(event) {
                                var output = document.getElementById('featured_image_preview');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="">Контент</label>
                        <textarea
                            name="content"
                            id=""
                            class="form-control"
                            placeholder="Текст события"
                        ></textarea>
                        @error('content')
                            <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-block">
                        <button type="submit" class="btn badge-primary">Добавить событие</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-box mb-2">
                    <div class="card-header weight-500">SEO</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Введите ключевые слова через запятую</label>
                            <input type="text" class="form-control" name="meta_keywords" placeholder="Введите ключевые слова">
                            @error('meta_keywords')
                                <small class="text-danger error-text title_error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Мета описание</label>
                            <textarea class="form-control" name="meta_description" placeholder="Введите мета-описание"></textarea>
                            @error('meta_description')
                                <small class="text-danger error-text title_error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
