@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title
        pageTitle="{{ $pageTitle }}"
        btnRoute="admin.add_page"
        btnIcon="bi bi-plus-circle"
        btnText="Создать"
        btnType="success"
    />

    @livewire('admin.pages.index')
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
