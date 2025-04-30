@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title
        pageTitle="{{ $pageTitle }}"
        btnRoute="admin.menu_items"
        btnIcon="bi bi-list"
        btnText="Список записей"
    />

    <form
        action="{{ route('admin.create_menu_item') }}"
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
                            value="{{ old('title') }}"
                        >
                        @error('title')
                            <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="custom-select col-12" name="parent_id">
                            <option value="">Выбрать родительскую категорию...</option>
                            @foreach($menuItems as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <input type="checkbox" name="is_page" id="is_page" value="{{ old('is_page') }}" />
                        <label for="is_page">Сформировать ссылку на страницу</label>
                    </div>
                    <div class="form-group">
                        <select class="custom-select col-12" name="slug_page" id="slug_page">
                            <option value="">Выбрать страницу</option>
                            @foreach($pages as $item)
                                <option value="{{ $item->slug }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ссылка</label>
                        <input
                            type="text"
                            class="form-control"
                            name="slug"
                            id="slug"
                            placeholder="Введите название"
                            value="{{ old('slug') }}"
                        >
                        @error('title')
                            <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Порядок</label>
                        <input
                            type="number"
                            min="0"
                            max="100"
                            class="form-control"
                            name="order"
                            placeholder="Введите значение"
                            value="0"
                            style="max-width: 200px"
                        >
                        @error('order')
                            <small class="text-danger error-text title_error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Видимость</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio1" class="custom-control-input" value="1" checked>
                            <label for="customRadio1" class="custom-control-label">Опубликовать</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio2" class="custom-control-input" value="0">
                            <label for="customRadio2" class="custom-control-label">Скрыть</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block mt-2 mb-3">
            <button type="submit" class="btn badge-success">Создать</button>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        const isPage = document.getElementById('is_page').onclick = setIsPage;
        const slugPage = document.getElementById('slug_page');
        const slug = document.getElementById('slug');

        slugPage.onchange = (e) => setSlug('page/' + e.target.value);
        slugPage.hidden = true;
        slugPage.disabled = true;

        function setIsPage (e) {
            if (e.target.checked) {
                slug.readOnly = true;
                slugPage.disabled = false;
                slugPage.hidden = false;
            } else {
                slugPage.hidden = true;
                slug.readOnly = false;
                slug.value = '';
                slugPage.disabled = true;
            }
        }

        function setSlug (val) {
            slug.value = val;
        }

    </script>
@endpush
