@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Профиль</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Профиль
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

@livewire('admin.profile')

@endsection
@push('scripts')
    <script>
        $('input[type="file"][id="profilePictureFile]').kropify({
            preview:'image#profilePicturePreview',
            viewMode:1,
            aspectRatio:1,
            cancelButtonText:'Cancel',
            resetButtonText:'Reset',
            cropButtonText:'Crop & update',
            processURL:'',
            maxSize:2097152, //2MB
            showLoader:true,
            animationClass:'headShake', //headShake, bounceIn, pulse
            fileName:'avatar',
            success:function(data){
                // console.log(data);
            },
            errors:function(error, text){
                console.log(text);
            },
        });
    </script>
@endpush
