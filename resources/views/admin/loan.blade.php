@extends('app')

@section('body')

    @include('admin/partials/_nav')

    @include('admin/partials/_handle_form', ['handle'=>'Loan', 'url' => 'admin/loan']);

@endsection