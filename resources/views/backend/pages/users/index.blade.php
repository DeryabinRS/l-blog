@extends('backend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <x-admin.page-title pageTitle="{{ $pageTitle }}" />

    @livewire('admin.users.index')
@endsection
