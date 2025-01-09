<header>
        <nav class="navbar navbar-expand-lg fixed-nav">
            <div class="container-fluid">
                <!-- Brand Logo and Text -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <picture>
                            <img src="./Images/logo.png" class="nav__logo" alt="Bengal Tandoori Restaurant Logo">
                        </picture>
                        <h3 class="logo__text px-2">BENGAL TANDOORI RESTAURANT</h3>
                    </a>
                </div>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse text-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menu">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Order Online</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        @if (Auth::user())
                        <li class="nav-item dropdown">


                            <a class="customItem dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->first_name }}
                            </a>

                            <ul class="dropdown-menu rounded-0">
                                <li><a class="dropdown-item" href="/profile">{{ Auth::user()->name }}</a></li>
                                @if (Auth::user()->is_admin())
                                <li><a class="dropdown-item" href="/admin/dashboard">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="/api/logout">Logout</a></li>
                            </ul>

                            @else
                        <li class="nav-item">
                            <a class="customItem" href="/login">Login</a>
                            @endif
                            <!-- same ending for both -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>