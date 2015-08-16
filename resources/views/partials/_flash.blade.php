@if(Session::has('flash_message'))

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3">

                <div class="alert alert-success" id="flashMessage">

                    <strong><i class="fa fa-thumbs-o-up"></i> Successful!</strong>  {{session('flash_message')}}

                </div>
            </div>

        </div>

    </div>

@endif