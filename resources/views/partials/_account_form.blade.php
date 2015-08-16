<div class="container" id ="container_main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $handle }} </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('flash::message')
                    @if(isset($user))
                        {!! Form::model($user, ['url'=>$url, 'class'=>'form-horizontal', 'role'=>'form']) !!}
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ url($url) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @endif

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class'=>'form-control', $disabled]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                {!! Form::email('email', null, ['class'=>'form-control', 'type'=>'email', $disabled]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                {!! Form::select('role', ['1'=>'Administrator', '2'=>'Student'], null, ['class'=>'form-control', $disabled]) !!}
                            </div>
                        </div>

                        @if(isset($user))
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Re-Enter Password</label>
                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        @else
                            <input type="hidden" class="form-control" name="password" value="password">
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>