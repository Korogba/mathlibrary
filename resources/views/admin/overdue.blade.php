@extends('app')

@section('body')

    @include('admin/partials/_nav')

    @include('partials/_book_display', ['books' => $book, 'status' => 'Overdue', 'total'=> $total])

@endsection