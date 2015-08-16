@extends('app')

@section('body')

    @include('admin/partials/_nav')

    @include('partials._account_form', [
        'handle'=>'Edit My Account', 'url' => '/admin/profile', 'user' => $user, 'disabled' => 'disabled'
    ])

@endsection