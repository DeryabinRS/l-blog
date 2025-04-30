@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? env('APP_NAME'))
@section('content')
    <x-admin.page-title
        pageTitle="{{ $pageTitle }}"
        btnRoute="admin.add_menu_item"
        btnIcon="bi bi-plus-circle"
        btnText="Создать"
        btnType="success"
    />
    @livewire('admin.menu.index')
@endsection
@push('scripts')
    <script>
        window.addEventListener('deleteRecord', (data) => {
            const id = data.detail[0].id;
            swal({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function (data) {
                if (data.value) {
                    Livewire.dispatch('deleteAction', [id]);
                }
            });
        });
    </script>
@endpush
