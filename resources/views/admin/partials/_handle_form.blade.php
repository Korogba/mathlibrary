<div class="container">

    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            <h2 class="mb-none">{{ $handle }} Book</h2>
            <p>Enter student number and book ISBN below to {{ strtolower($handle) }} book.</p>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse">
                                {{ $handle }} Form
                            </a>
                        </h4>
                    </div>
                    <div id="collapse" class="accordion-body collapse in">
                        <div class="panel-body">
                            {!! Form::open(['url'=>$url]) !!}
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Student Email</label>
                                            <input type="email" required name="student_number" class="form-control" placeholder="student@abu.edu.ng">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Book ISBN</label>
                                            <input type="text" name="isbn" required class="form-control" placeholder="0123456789">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" value="Submit" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('partials.errors')

    </div>

</div>