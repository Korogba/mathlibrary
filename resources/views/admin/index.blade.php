@extends('app')

@section('body')
    @include('admin/partials/_nav')

    <div class="container" id ="container_main">

        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-none">Library Search</h2>
                <p>Enter search criteria below to locate book in the library</p>

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
                                {!! Form::open(['url'=>'/admin/search']) !!}
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Enter Key Words</label>
                                                <input type="text" name="key_words" class="form-control" required placeholder="Author Publisher Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="form" value="basic_search">
                                        <div class="col-md-12">
                                            <input type="submit" value="Submit" class="btn btn-primary mt-x pull-right">
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
                                {!! Form::open(['url'=>'/admin/search']) !!}
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>ISBN Number</label>
                                                <input type="text" name="isbn" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Author</label>
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
                                        <input type="hidden" name="form" value="refined_search">
                                        <div class="col-md-12">
                                            <input type="submit" value="Submit" class="btn btn-primary mt-x pull-right">
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="mb-none">Student Search</h2>
                <p>Enter search criteria below to locate student record</p>

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse">
                                    Basic Search
                                </a>
                            </h4>
                        </div>
                        <div id="collapse" class="accordion-body collapse">
                            <div class="panel-body">
                                {!! Form::open(['url'=>'/admin/search']) !!}
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Student Email</label>
                                                <input type="email" name="student_mail" class="form-control" placeholder="student@abu.edu.ng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Student Name</label>
                                                <input type="text" name="student_name" class="form-control" placeholder="Muhammad Abubakar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="form" value="student_search">
                                        <div class="col-md-12">
                                            <input type="submit" value="Submit" class="btn btn-primary mt-x pull-right">
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        @include('partials.errors')

    </div>

@endsection