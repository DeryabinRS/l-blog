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
        action="{{ route('admin.update_post') }}"
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
                        <label for="">Название</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Введите название"
                            value="{{$post->title}}"
                        >
                        @error('title')
                        <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Категория события</label>
                        <select class="custom-select col-12" name="post_category">
                            @foreach($post_categories as $item)
                                <option value="{{ $item->id }}" {{ $post->post_category == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('post_category')
                        <small class="text-danger error-text post_category_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Контент</label>
                        <textarea
                            name="content"
                            id="content"
                            class="ckeditor form-control"
                            placeholder="Текст события"
                        >{!! $post->content !!}</textarea>
                        @error('content')
                        <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="card card-box">
                        <div class="card-header weight-500">SEO</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Введите ключевые слова через запятую</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="meta_keywords"
                                    placeholder="Введите ключевые слова"
                                    value="{{ $post->meta_keywords }}"
                                >
                                @error('meta_keywords')
                                <small class="text-danger error-text title_error">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Мета описание</label>
                                <textarea
                                    class="form-control"
                                    name="meta_description"
                                    placeholder="Введите мета-описание"
                                >value="{{ $post->meta_description }}"</textarea>
                                @error('meta_description')
                                <small class="text-danger error-text title_error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-box mb-2">
                    <div class="card-header weight-500">Параметры события</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Изображение <small class="text-danger">(800px*800px)</small>:</label>
                            <div class="d-block mb-3" style="max-width: 100%">
                                <img src="/images/posts/{{ $post->featured_image }}" alt="" class="img-thumbnail img-fluid" id="featured_image_preview">
                            </div>
                            <input type="file" onchange="loadFile(event)" id="featured_image" name="featured_image" class="form-control-file form-control height-auto">
                            @error('featured_image')
                            <small class="text-danger error-text featured_image_error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Теги</label><br>
                            <input
                                type="text"
                                class="form-control"
                                name="tags"
                                placeholder="Введите теги"
                                data-role="tagsinput"
                                value="{{ $post->tags }}"
                            >
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="">Видимость</label>
                            <div class="custom-control custom-radio mb-5">
                                <input
                                    type="radio"
                                    name="visibility"
                                    id="customRadio1"
                                    class="custom-control-input"
                                    value="1"
                                    {{ $post->visibility == 1 ? 'checked' : '' }}
                                >
                                <label for="customRadio1" class="custom-control-label">Опубликовать</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input
                                    type="radio"
                                    name="visibility"
                                    id="customRadio2"
                                    class="custom-control-input"
                                    value="0"
                                    {{ $post->visibility == 0 ? 'checked' : '' }}
                                >
                                <label for="customRadio2" class="custom-control-label">Скрыть</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block mt-2 mb-3">
            <button type="submit" class="btn badge-primary">Сохранить</button>
        </div>
    </form>
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endpush
@push('scripts')
    <script src="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        const loadFile = function(event) {
            const output = document.getElementById('featured_image_preview');
            const input = document.getElementById('featured_image');
            const file = event.target?.files[0];
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (file){
                if (validImageTypes.includes(file['type'])) {
                    output.src = URL.createObjectURL(event.target?.files[0]);
                } else {
                    swal({
                        type: 'error',
                        title: 'Разрешенные форматы: jpeg, jpg, png',
                        timerProgressBar: true,
                        showCancelButton: true,
                        showConfirmButton: false,
                        timer: 4500,
                    });
                    input.value = '';
                }
            } else {
                output.src = '';
                input.value = '';
            }
            if (output?.src) {
                output.onload = function() {
                    URL.revokeObjectURL(output?.src) // free memory
                }
            }
        };
    </script>
@endpush
