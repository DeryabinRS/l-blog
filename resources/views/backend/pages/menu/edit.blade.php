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
        action="{{ route('admin.update_menu_item', [ 'id' => $manuItem->id ]) }}"
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
