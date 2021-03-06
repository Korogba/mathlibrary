@extends('app')

@section('body')

    @include('student/partials/_nav')

    <div class="shop">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="portfolio-title">
                        <div class="row">
                            <div class="portfolio-nav-all col-md-1">
                                <a href="{{ URL::previous() }}" data-tooltip data-original-title="Back to list"><i class="fa fa-th"></i></a>
                            </div>
                            <div class="col-md-10 center">
                                <h2 class="mb-none">{{ $book->title }} <small>by  {{ $book->getAuthor() }}</small></h2>
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
                                        <i class="fa fa-info-circle"></i>
                                        <strong>
                                            @if($status == '0')
                                                Not Reserved
                                            @elseif($status == '1')
                                                Reserved
                                            @elseif($status == '2')
                                                Loaned
                                            @endif
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h4 class="heading-primary">Book <strong>Description</strong></h4>
                    <p class="mt-xlg">{{ $book->summary }}</p>

                    <a href="{{ action('StudentController@reservation', $book->id ) }}" class="btn btn-primary btn-lg btn-icon {{ $status == 2 ? 'disabled':''}}"><i class="fa fa-external-link"></i>
                        @if($status == '0')
                            Make Reservation
                        @elseif($status == '1')
                            Cancel Reservation
                        @elseif($status == '2')
                            Book Loaned
                        @endif
                    </a>
                    <span class="arrow hlb" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800"></span>
                    <h4 class="mt-lg"> <span class="label label-info">{{ $book->getStock() }}</span><strong></strong> copies available</h4>
                    @if($status == '2')
                        <p><strong>Return Date: </strong>
                            {{ auth()->user()->getExpires($book->id) }}
                        </p>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <hr class="tall">

                    @include('partials.errors')

                    <div class="tabs tabs-product">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#bookInfo" data-toggle="tab">Aditional Information</a></li>
                            <li><a href="#bookReviews" data-toggle="tab">Reviews ({{ $comment->count() }})</a></li>
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
                            <div class="tab-pane" id="bookReviews">
                                <ul class="comments">
                                    @if( !$comment->isEmpty() )
                                        @foreach($comment as $review)
                                            <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="{{ asset('img/avatar-2.jpg') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                            <span class="comment-by">
                                                                <strong>{{ $review->user->name }}</strong>
                                                                <span class="pull-right">
                                                                    <div title="Rated {{ $review->rating }} out of 5" class="star-rating">
                                                                        <span style="{{ 'width:'.($review->rating*20).'%' }}"><strong class="rating">{{ $review->rating }}</strong> out of 5</span>
                                                                    </div>
                                                                </span>
                                                            </span>
                                                        <p> {{ $review->comment }} </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="row">
                                                <div class="col-md-6 comment">
                                                    <div class="comment-block">
                                                        <p>No reviews made</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                <hr class="tall">
                                <h4 class="heading-primary">{{ $my_comment ? 'Edit':'Add' }} review</h4>
                                <div class="row">
                                    <div class="col-md-12">

                                        {!! Form::open(['url'=> $my_comment ? 'student/edit_review':'student/review']) !!}

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Comment </label>
                                                        <input type="hidden" name="book" value="{{ $book->id }}">
                                                        <textarea maxlength="5000" required rows="5" class="form-control" name="comment">{{ $my_comment ? $comment->where('user_id', auth()->user()->id)->first()->comment: '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>Rating </label>
                                                        <input type="number" name="rating" data-max="5" data-min="1"
                                                               class="rating form-control" data-clearable="clear" data-icon-lib="fa"
                                                               data-active-icon="fa-star" data-inactive-icon="fa-star-o"
                                                               data-empty-value="0" data-clearable-icon="fa-trash-o">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" value="{{ $my_comment ? 'Edit':'Add' }} Review" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                </div>
                                            </div>

                                        {!! Form::close() !!}

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <hr class="tall">

                    <h4 class="mb-md text-uppercase">Related <strong>Books</strong></h4>

                    <div class="row">

                        <ul class="portfolio-list">
                            <li class="col-md-4 col-sm-6 col-xs-12">
                                <div class="portfolio-item">
                                    <a href="#">
                                            <span class="thumb-info">
                                                <span class="thumb-info-wrapper">
                                                    <img src="{{ asset('img/projects/project.jpg') }}" class="img-responsive" alt="">
                                                    <span class="thumb-info-title">
                                                        <span class="thumb-info-inner">Fundamentals of Electrical/Electronic Engineering</span>
                                                        <span class="thumb-info-type">B L Theraja</span>
                                                    </span>
                                                    <span class="thumb-info-action">
                                                        <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                                    </span>
                                                </span>
                                            </span>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-4 col-sm-6 col-xs-12">
                                <div class="portfolio-item">
                                    <a href="#">
                                            <span class="thumb-info">
                                                <span class="thumb-info-wrapper">
                                                    <img src="{{ asset('img/projects/project-2.jpg') }}" class="img-responsive" alt="">
                                                    <span class="thumb-info-title">
                                                        <span class="thumb-info-inner">Computer Architecture and The Likes</span>
                                                        <span class="thumb-info-type">Donfack Kana</span>
                                                    </span>
                                                    <span class="thumb-info-action">
                                                        <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                                    </span>
                                                </span>
                                            </span>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-4 col-sm-6 col-xs-12">
                                <div class="portfolio-item">
                                    <a href="#">
                                            <span class="thumb-info">
                                                <span class="thumb-info-wrapper">
                                                    <img src="{{ asset('img/projects/project-3.jpg') }}" class="img-responsive" alt="">
                                                    <span class="thumb-info-title">
                                                        <span class="thumb-info-inner">Trials and Travails of php and Python</span>
                                                        <span class="thumb-info-type">Khalil Muhammad</span>
                                                    </span>
                                                    <span class="thumb-info-action">
                                                        <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                                    </span>
                                                </span>
                                            </span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('footer')

    <!-- Page specific script for ratings selection -->
    <script src="{{ asset('js/bootstrap-rating-input.js') }}"></script>

@endsection
