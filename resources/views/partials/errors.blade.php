@if($errors->any())

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="alert alert-danger alert-dismissible p-xlg mt-xlg" role="alert">
                <div class="row pr-lg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><i class="fa fa-warning"></i>Oh snap!</strong> Change a few things up and try submitting again.
                </div>
                <div class="row">
                    <div class="col-md-12 align-left">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endif
@if (Session::has('flash_notification.message'))
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
        </div>

    </div>
@endif