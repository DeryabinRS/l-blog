@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title
        pageTitle="{{ $pageTitle }}"
        btnRoute="admin.add_post"
        btnIcon="bi-plus-circle"
        btnText="Создать"
        btnType="success"
    />

    @livewire('admin.posts.store')
@endsection
@push('scripts')
    <script>
        window.addEventListener('deletePost', (data) => {
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
                    Livewire.dispatch('deletePostAction', [id]);
                }
            });
        });
    </script>
@endpush
