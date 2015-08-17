@extends('app')

@section('body')

    @include('admin/partials/_nav')

    @include('partials/_book_display', ['books' => $results, 'total' => $total])

@endsection