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
                <a href="{{ route('admin.add_post') }}" class="btn btn-success">
                    <i class="icon-copy bi bi-plus-circle"></i> Создать
                </a>
            </div>
        </div>
    </div>

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
