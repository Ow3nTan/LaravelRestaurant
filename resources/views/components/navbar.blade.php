<!-- START NAVBAR SECTION -->

<header id="header" class="header-section">
    <div class="container">
        <nav class="navbar">
            <a href="home" class="navbar-brand">
                <img src="{{ asset('images/restaurant-logo.png') }}" alt="Restaurant Logo" style="width: 150px;">
            </a>
            <div class="d-flex menu-wrap align-items-center">
                <div class="mainmenu" id="mainmenu">
                    <ul class="nav">
                        <li><a href="#home">HOME</a></li>
                        <li><a href="#menus">MENUS</a></li>
                        <li><a href="#gallery">GALLERY</a></li>
                        <li><a href="#about">ABOUT</a></li>
                        <li><a href="#contact">CONTACT</a></li>
                    </ul>
                </div>

                @auth <!-- Check if user is authenticated -->
                    @if (Auth::user()->isAdmin())
                        <!-- Check if the authenticated user is an admin -->
                        <div class="header-btn" style="margin-left:10px">
                            <a href="{{ url('dashboard') }}" class="menu-btn" style="background-color: #008000">Admin
                                Dashboard</a>
                        </div>
                    @else
                        <div class="header-btn" style="margin-left:10px">
                            <a href="{{ url('tableReserve') }}" target="_blank" class="menu-btn">Reserve Table</a>
                        </div>
                    @endif
                    <div class="header-btn" style="margin-left:10px">
                        <a href="{{ url('logout') }}" class="menu-btn" style="background-color: #ed143d">Logout</a>
                    </div>
                @endauth
                @guest <!-- If user is not authenticated -->
                    <div class="header-btn" style="margin-left:10px">
                        <a href="{{ route('login') }}" class="menu-btn">Login</a>
                    </div>
                @endguest
            </div>
        </nav>
    </div>
</header>

<div class="header-height" style="height: 120px;"></div>

<!-- END NAVBAR SECTION -->
