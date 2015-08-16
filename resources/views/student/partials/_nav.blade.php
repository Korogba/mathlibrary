<header id="header">
    <div class="container">
        <div class="logo">
            <a href="#">
                <img alt="logo image" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="{{ asset('img/logo.png') }}">
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
                    <li class="{{ set_active('student') }}">
                        <a href="{{ url('student') }}">
                            Home
                        </a>
                    </li>
                    <li class="{{ set_active('student/records') }}">
                        <a href="{{ url('student/records') }}">
                            Book Records
                        </a>
                    </li>
                    <li class="{{ set_active('student/search') }}">
                        <a  href="{{ url('student/search') }}" data-toggle="tooltip" data-placement="left" title="Clicking here returns entire library collection.">
                            Search
                        </a>
                    </li>
                    <li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
                        <a class="dropdown-toggle" href="{{ url('student/profile') }}">
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
                                                    <a href="{{ url('student/profile') }}">Profile</a>
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
                        Welcome <em>{{ $name }}</em>, search for available books in the Maths library
                        <span>Check availability and reserve books for easy borrowing.</span>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>