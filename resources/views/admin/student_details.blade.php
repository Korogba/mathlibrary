@extends('app')

@section('body')

    @include('admin/partials/_nav')

    <div class="container" id ="container_main">

        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-none"> {{ $student->name }} <small> {{ $student->email }}</small></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <hr class="tall">

                @include('partials.errors')

                <div class="tabs tabs-product">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#loan" data-toggle="tab">Loaned Books ({{ sizeof($loaned->all()) }})</a></li>
                        <li><a href="#reserved" data-toggle="tab">Reserved Books ({{ sizeof($reservation->all()) }})</a></li>
                        <li><a href="#overdue" data-toggle="tab">Overdue Books ({{ sizeof($overdue->all()) }})</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="loan">
                            <ul class="comments">
                                @forelse($loaned->all() as $book)
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="{{ !empty($book->image) ? url($book->image) : asset('img/avatar-2.jpg') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                    <span class="comment-by">
                                                        <strong>{{ $book->title }}</strong> by {{ $book->getAuthor() }}
                                                    </span>
                                                        <p>{{ $book->summary }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <a class="btn btn-primary btn-lg" href="{{ action('AdminController@update_receive', [$student->id, $book->id]) }}">Receive</a>
                                            </div>

                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="comment-block">
                                                            <span class="comment-by">
                                                            <strong>No loaned books</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="tab-pane" id="reserved">
                            <ul class="comments">
                                @forelse($reservation->all() as $book)
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="{{ !empty($book->image) ? url($book->image) : asset('img/avatar-2.jpg') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                    <span class="comment-by">
                                                        <strong>{{ $book->title }}</strong> by {{ $book->getAuthor() }}
                                                    </span>
                                                        <p>{{ $book->summary }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <a class="btn btn-primary btn-lg" href="{{ action('AdminController@update_loan', [$student->id, $book->id]) }}">Loan out</a>
                                            </div>

                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="comment-block">
                                                            <span class="comment-by">
                                                            <strong>No loaned books</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="tab-pane" id="overdue">
                            <ul class="comments">
                                @forelse($overdue->all() as $book)
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="{{ !empty($book->image) ? url($book->image) : asset('img/avatar-2.jpg') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                    <span class="comment-by">
                                                        <strong>{{ $book->title }}</strong> by {{ $book->getAuthor() }}
                                                    </span>
                                                        <p>{{ $book->summary }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <a class="btn btn-primary btn-lg" href="#">Receive</a>
                                            </div>

                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="comment-block">
                                                            <span class="comment-by">
                                                            <strong>No loaned books</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section section-quaternary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-none text-light">Disable this user</h4>
                        <p class="mb-none text-light">The student can be disabled from using this portal by clicking <a href="#">here</a> </p>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection