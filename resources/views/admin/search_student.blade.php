@extends('app')

@section('body')

    @include('admin/partials/_nav')

    <div class="container" id ="container_main">

        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-none">Search Results<small> Students</small></h2>
                <p>{{ sizeof($students) }} result(s) returned</p>
                @if(sizeof($students) == 0)
                    <a class="mb-xs mt-xs btn btn-default" href="{{ URL::previous() }}">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                @endif
            </div>
        </div>

        @foreach(array_chunk($students, 4) as $row)

            <div class="row">

                @foreach($row as $student)

                    <div class="col-md-3">
                        <h4><a href="{{ route('student', ['email' => $student->email]) }}">{{ $student->name }}</a></h4>

                        <blockquote class="with-borders">
                            <ul class="list list-icons list-icons-style-3 list-secondary">
                                <li><i class="fa fa-warning"></i> <span class="heading-secondary">{{ $student->getOverdue()->count() }}</span> Overdue book(s)</li>
                            </ul>

                            <ul class="list list-icons list-icons-style-3 list-tertiary">
                                <li><i class="fa fa-plus"></i> <span class="heading-tertiary">{{ $student->getLoan()->count() }}</span> Loaned book(s)</li>
                            </ul>

                            <ul class="list list-icons list-icons-style-3 list-primary">
                                <li><i class="fa fa-check"></i> <span class="heading-primary">{{ $student->getReservations()->count() }}</span> Reserved book(s)</li>
                            </ul>
                            <footer>Student Email: <cite title="Source Title">{{ $student->email }}</cite></footer>
                        </blockquote>
                    </div>

                @endforeach

            </div>

        @endforeach

    </div>

@endsection