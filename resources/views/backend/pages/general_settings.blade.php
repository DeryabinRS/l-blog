@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
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
        </div>
    </div>

    <div class="pd-20 card-box mb-4">
        @livewire('admin.settings')
    </div>
@endsection
@push('scripts')
    <script>
        $('input[type="file"][id="siteLogoFile"]').kropify({
            preview:'image#siteLogoPreview',
            aspectRatio:200/50,
            cancelButtonText:'Cancel',
            resetButtonText:'Reset',
            cropButtonText:'Crop & update',
            processURL:'{{ route("admin.update_site_logo") }}',
            maxSize:2097152, //2MB
            showLoader:true,
            success:function(data){
                if (data.status === 1) {
                    Livewire.dispatch('updateTopUserInfo', []);
                    Livewire.dispatch('updateProfile', []);

                    swal({
                        toast: true,
                        position: 'top-end',
                        type: 'success',
                        title: data.message,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 2500
                    });
                } else {
                    swal({
                        toast: true,
                        position: 'top-end',
                        type: 'error',
                        title: data.message,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            },
            errors:function(error, text){
                console.log(text);
            },
        });
    </script>
@endpush
