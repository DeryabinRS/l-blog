@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    @livewire('admin.post-categories')
@endsection
@push('scripts')
    <script>
        window.addEventListener('showPostCategoryModalForm', function () {
            $('#post_category_modal').modal('show');
        });

        window.addEventListener('hidePostCategoryModalForm', function () {
            $('#post_category_modal').modal('hide');
        });

        window.addEventListener('deletePostCategoryForm', (data) => {
            const id = data.detail[0].id;
            swal({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function (data) {
                console.log(data.value)
                if (data.value) {
                    Livewire.dispatch('deletePostCategory', [id]);
                }
            })
        });
    </script>
@endpush
