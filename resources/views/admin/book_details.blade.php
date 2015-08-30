@extends('app')

@section('body')

    @include('admin/partials/_nav')

    <div role="main" class="main shop">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="portfolio-title">
                        <div class="row">
                            <div class="portfolio-nav-all col-md-1">
                                <a href="{{ URL::previous() }}" data-tooltip data-original-title="Back to list"><i class="fa fa-th"></i></a>
                            </div>
                            <div class="col-md-10 center">
                                <h2 class="mb-none">{{ $book->title }} <small>by {{ $book->getAuthor() }}</small></h2>
                            </div>
                        </div>
                    </div>

                    <hr class="tall">
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <span class="img-thumbnail">
                        <img alt="{{ $book->title }}" class="img-responsive" src="{{ !empty($book->image) ? url($book->image) : asset('img/projects/project-1.jpg') }}">
                    </span>
                </div>

                <div class="col-md-8">

                    <div class="portfolio-info">
                        <div class="row">
                            <div class="col-md-12 center">
                                <ul>
                                    <li>
                                        <i class="fa fa-info-circle"></i> {{ $book->quantity }} Copies Total
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i> {{ $book->getStock() }} Copies Available
                                    </li>
                                    <li>
                                        <i class="fa fa-close"></i> {{ $book->quantity - $book->getStock() }} Copies Loaned
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h4 class="heading-primary">Book <strong>Description</strong></h4>
                    <p class="mt-xlg"> {{ $book->summary }} </p>

                    <ul class="list list-icons list-icons-style-3 list-secondary">
                        <li><i class="fa fa-warning"></i> <span class="heading-secondary">{{ $book->getOverdue()->count() }}</span> Overdue book(s)</li>
                    </ul>

                    <ul class="list list-icons list-icons-style-3 list-primary">
                        <li><i class="fa fa-check"></i> <span class="heading-primary">{{ $book->getReservations()->count() }}</span> Reservation(s)</li>
                    </ul>

                    <a href="{{ action('AdminController@edit', $book->id )}}" class="btn btn-primary btn-lg btn-icon"><i class="fa fa-external-link"></i>
                        Edit Book
                    </a>
                    <span class="arrow hlb" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800"></span>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <hr class="tall">

                    @include('partials.errors')

                    <div class="tabs tabs-product">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#bookInfo" data-toggle="tab">Aditional Information</a></li>
                            <li><a href="#bookRecords" data-toggle="tab">Book Records</a></li>
                            <li><a href="#bookReviews" data-toggle="tab">Reviews (2)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="bookInfo">
                                <table class="table table-striped mt-xl">
                                    <tbody>
                                    <tr>
                                        <th>
                                            Publisher:
                                        </th>
                                        <td>
                                            {{ $book->publisher->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Year:
                                        </th>
                                        <td>
                                            {{ $book->edition }} Edition, {{ $book->year }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            ISBN:
                                        </th>
                                        <td>
                                            {{ $book->isbn }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="bookRecords">
                                @if( !$book->getOverdue()->isEmpty() || !$book->getReservations()->isEmpty() || !$book->getLoan()->isEmpty() )
                                    <table class="table table-bordered align-center">
                                        <thead>
                                            <tr>
                                                <th class="align-center">
                                                    Student Name
                                                </th>
                                                <th class="align-center">
                                                    Status
                                                </th>
                                                <th class="align-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($book->getLoan() as $loanee)
                                            <tr>
                                                <td> <a href="{{ route('student', ['email' => $loanee->email]) }}">{{ $loanee->name }}</a> </td>
                                                <td class="success"> Loaned </td>
                                                <td> <a href="{{ action('AdminController@update_receive', [$loanee->id, $book->id]) }}">Receive</a> </td>
                                            </tr>
                                         @endforeach
                                        @foreach($book->getReservations() as $reserved)
                                            <tr>
                                                <td> <a href="{{ route('student', ['email' => $reserved->email]) }}">{{ $reserved->name }}</a> </td>
                                                <td class="info"> Reserved </td>
                                                <td> <a href="{{ action('AdminController@update_loan', [$reserved->id, $book->id]) }}">Loan out</a> </td>
                                            </tr>
                                        @endforeach
                                        @foreach($book->getOverdue() as $overdue)
                                            <tr>
                                                <td> <a href="{{ route('student', ['email' => $overdue->email]) }}">{{ $overdue->name }}</a> </td>
                                                <td class="danger"> Overdue </td>
                                                <td> <a href="{{ action('AdminController@update_receive', [$overdue->id, $book->id]) }}">Receive</a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="comment-block">
                                        <p> All copies of this book are available in the library. </p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="bookReviews">
                                <ul class="comments">
                                    <li>
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="{{ url('img/avatar-2.jpg') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
														<span class="comment-by">
															<strong>John Doe</strong>
															<span class="pull-right">
																<div title="Rated 5.00 out of 5" class="star-rating">
                                                                    <span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>
                                                                </div>
															</span>
														</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <a class="btn btn-lg btn-danger" href="#">Delete Review</a>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection