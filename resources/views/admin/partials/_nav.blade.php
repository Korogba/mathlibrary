<header id="header">
    <div class="container">
        <div class="logo">
            <a href="{{ url('admin') }}">
                <img alt="logo image" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="{{ asset('/img/logo.png') }}">
            </a>
        </div>
        <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
            <nav class="nav-main mega-menu">
                <ul class="nav nav-pills nav-main" id="mainMenu">
                    <li class="{{ set_active('admin') }}">
                        <a href="{{ url('admin') }}">
                            Home
                        </a>
                    </li>
                    <li class="dropdown {{ set_active('admin/receive', 'admin/loan') }}">
                        <a class="dropdown-toggle" href="#">
                            Transactions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('admin/receive') }}">Receive Book</a></li>
                            <li><a href="{{ url('admin/loan') }}">Loan Book</a></li>
                        </ul>
                    </li>
                    <li class="dropdown {{ set_active('admin/overdue', 'admin/reserved') }}">
                        <a class="dropdown-toggle" href="#">
                            Book Records
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('admin/overdue') }}">Overdue Books</a></li>
                            <li><a href="{{ url('admin/reserved') }}">Reserved Books</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active('admin/add', 'admin/edit') }}">
                        <a href="{{ url('admin/add') }}">
                            Add Book
                        </a>
                    </li>
                    <li class="{{ set_active('auth/register') }}">
                        <a href="{{ url('auth/register') }}">
                            Create Account
                        </a>
                    </li>
                    <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                        <a class="dropdown-toggle" href="{{ url('admin/profile') }}">
                            <i class="fa fa-user"></i> {{ $name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="mega-menu-content">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="user-avatar">
                                                <div class="img-thumbnail">
                                                    <img src="{{ asset('img/clients/client-1.jpg') }}" alt="">
                                                </div>
                                                <p><strong>{{ $name }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-account-options">
                                                <li>
                                                    <a href="{{ url('admin/profile') }}">Profile</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('auth/logout') }}">Log Out</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div role="main" class="main">
    <div class="home-intro mb-xlg" id="home-intro">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <p>
                        Welcome <strong>{{ $name }}</strong>, loan out, receive and keep track of all Library materials
                        <span>Also search for overdue books and availability status of each book.</span>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>