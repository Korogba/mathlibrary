@extends('app')

@section('body')

    @include('admin/partials/_nav')

    @include('partials._account_form', ['handle'=>'Create New User', 'url' => '/auth/register', 'disabled' => ''])

@endsection
