@extends('app')

@section('body')

    @include('student/partials/_nav')

    <div class="container" id ="container_main">

        <div class="row">
            <div class="col-md-9">

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Basic Search
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse">
                            <div class="panel-body">
                                {!! Form::open(['url'=>'/student/search']) !!}
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Enter Key Words</label>
                                            <input type="text" name="key_words" class="form-control" required placeholder="Author Publisher Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="form" value="basic_search">
                                        <input type="submit" value="Submit" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Refined Search
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="panel-body">
                                {!! Form::open(['url'=>'/student/search']) !!}
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>Book's ISBN</label>
                                            <input type="text" name="isbn" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Author's Name</label>
                                            <input type="text" name="author" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Publisher's name</label>
                                            <input type="text" name="publisher" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="form" value="refined_search">
                                        <input type="submit" value="Submit" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <ul class="list list-icons list-icons-style-3 list-secondary">
                    <li><i class="fa fa-warning"></i> <span class="heading-secondary">{{ auth()->user()->getOverdue()->count() }}</span> Overdue book(s)</li>
                </ul>

                <ul class="list list-icons list-icons-style-3 list-tertiary">
                    <li><i class="fa fa-plus"></i> <span class="heading-tertiary">{{ auth()->user()->getLoan()->count() }}</span> Loaned book(s)</li>
                </ul>

                <ul class="list list-icons list-icons-style-3 list-primary">
                    <li><i class="fa fa-check"></i> <span class="heading-primary">{{ auth()->user()->getReservations()->count() }}</span> Reserved book(s)</li>
                </ul>

            </div>

        </div>

        @include('partials.errors')

    </div>


@endsection