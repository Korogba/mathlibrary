@extends('app')

@section('body')

    @include('student/partials/_nav')

    @include('partials._account_form', [
        'handle'=>'Edit My Account', 'url' => '/student/profile', 'user' => $user, 'disabled' => 'disabled'
    ])

@endsection