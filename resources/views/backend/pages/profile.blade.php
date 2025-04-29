@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title pageTitle="{{ $pageTitle }}" />
    @livewire('admin.profile')
@endsection
@push('scripts')
    <script>
        $('input[type="file"][id="profilePictureFile"]').kropify({
            preview:'image#profilePicturePreview',
            viewMode:1,
            aspectRatio:1,
            cancelButtonText:'Cancel',
            resetButtonText:'Reset',
            cropButtonText:'Crop & update',
            processURL:'{{ route("admin.update_profile_picture") }}',
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
