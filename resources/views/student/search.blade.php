@extends('app')

@section('body')

    @include('student/partials/_nav')

    @include('partials/_book_display', ['books' => $results['hits']])

@endsection