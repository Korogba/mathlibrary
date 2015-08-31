@extends('app')

@section('body')

    @include('student/partials/_nav')

    <div class="container" id="main">

        <h2 class="mb-lg">Book Records</h2>

        @if(auth()->user()->transact->count() != 0)

            <ul class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options='{"filter": ".reserved, .loaned"}'>
                <li data-option-value=".reserved, .loaned" class="active"><a href="#">Show All</a></li>
                @if(sizeof($reservation->all()) != 0)
                    <li data-option-value=".reserved"><a href="#">Reserved Books</a></li>
                @endif
                @if(sizeof($loaned->all()) != 0)
                    <li data-option-value=".loaned"><a href="#">Loaned Books</a></li>
                @endif
                @if(sizeof($overdue->all()) != 0)
                    <li data-option-value=".overdue"><a href="#">Overdue Books</a></li>
                @endif
            </ul>

            <hr>

            <div class="row">

                <ul class="portfolio-list sort-destination" data-sort-id="portfolio">

                    @foreach($overdue->all() as $book)
                        <li class="col-md-4 col-sm-6 col-xs-12 isotope-item overdue">
                            <div class="portfolio-item">
                                <a href="{{ url('student/'.$book->id.'/show') }}">
                                    <span class="thumb-info">
                                        <span class="thumb-info-wrapper">
                                            <img src="{{ !empty($book->image) ? url($book->image) : asset('img/projects/project-5.jpg') }}" class="img-responsive" alt="{{ $book->title }}">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner">{{ $book->title }}</span>
                                                <span class="thumb-info-type">{{ $book->getAuthor() }}</span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                    @foreach($loaned->all() as $book)
                        <li class="col-md-4 col-sm-6 col-xs-12 isotope-item loaned">
                            <div class="portfolio-item">
                                <a href="{{ url('student/'.$book->id.'/show') }}">
                                    <span class="thumb-info">
                                        <span class="thumb-info-wrapper">
                                            <img src="{{ !empty($book->image) ? url($book->image) : asset('img/projects/project-5.jpg') }}" class="img-responsive" alt="{{ $book->title }}">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner">{{ $book->title }}</span>
                                                <span class="thumb-info-type">{{ $book->getAuthor() }}</span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                    @foreach($reservation->all() as $book)
                        <li class="col-md-4 col-sm-6 col-xs-12 isotope-item reserved">
                            <div class="portfolio-item">
                                <a href="{{ url('student/'.$book->id.'/show') }}">
                                    <span class="thumb-info">
                                        <span class="thumb-info-wrapper">
                                            <img src="{{ !empty($book->image) ? url($book->image) : asset('img/projects/project-5.jpg') }}" class="img-responsive" alt="{{ $book->title }}">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner">{{ $book->title }}</span>
                                                <span class="thumb-info-type">{{ $book->getAuthor() }}</span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </div>

        @else

            <div class="alert alert-warning alert-lg">
                You have no records to display
            </div>

        @endif

    </div>

@endsection