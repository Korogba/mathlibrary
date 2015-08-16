@extends('app')

@section('body')

    @include('admin/partials/_nav')

    <div class="container">

        <div class="row">

            <div class="col-md-9 col-md-offset-1">
                <h2 class="mb-none">{{ $book->title }} <small> Edit Book</small></h2>
                <p>By {{ $book->getAuthor() }}</p>

                @include('partials.errors')

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
                                {!! Form::model($book, ['url'=>['/admin/edit', $book->id], 'id'=>'contactFormAdvanced', 'files' => true]) !!}

                                    @include('admin/partials/_handle_book', ['disabled'=>'disabled', 'isbn'=>$book->isbn])

                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection