@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title
        pageTitle="{{ $pageTitle }}"
        btnRoute="admin.pages"
        btnIcon="bi bi-list"
        btnText="Список записей"
    />

    <form
        action="{{ route('admin.update_page', [ 'id' => $page->id ]) }}"
        method="POST"
        autocomplete="off"
    >
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-box mb-2 p-4">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Введите название"
                            value="{{$page->title}}"
                        >
                        @error('title')
                        <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Контент</label>
                        <textarea
                            name="content"
                            id="content"
                            class="ckeditor form-control"
                            placeholder="Текст события"
                        >{!! $page->content !!}</textarea>
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
                                    value="{{ $page->meta_keywords }}"
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
                                >{{ $page->meta_description }}</textarea>
                                @error('meta_description')
                                <small class="text-danger error-text title_error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Видимость</label>
                        <div class="custom-control custom-radio mb-5">
                            <input
                                type="radio"
                                name="visibility"
                                id="customRadio1"
                                class="custom-control-input"
                                value="1"
                                {{ $page->visibility == 1 ? 'checked' : '' }}
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
                                {{ $page->visibility == 0 ? 'checked' : '' }}
                            >
                            <label for="customRadio2" class="custom-control-label">Скрыть</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block mt-2 mb-3">
            <button type="submit" class="btn badge-success">Сохранить</button>
        </div>
    </form>
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endpush
@push('scripts')
    <script src="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/plugins/ckeditor/ckeditor.js"></script>
@endpush
