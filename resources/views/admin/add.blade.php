@extends('app')

@section('body')

    @include('admin/partials/_nav')

    <div class="container">

        <div class="row">

            @include('partials.errors')

            <div class="col-md-9  col-md-offset-1">
                <h2 class="mb-none">Add Book</h2>
                <p>Enter book details.</p>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse">
                                    Book Details
                                </a>
                            </h4>
                        </div>

                        <div id="collapse" class="accordion-body collapse in">
                            <div class="panel-body">
                                {!! Form::model($book = new \App\Book, ['url'=>'/admin/add', 'id'=>'contactFormAdvanced', 'files' => true]) !!}

                                    @include('admin/partials/_handle_book', ['disabled'=>'', 'isbn'=>''])

                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection