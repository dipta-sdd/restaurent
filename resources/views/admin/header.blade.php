<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle p-none" style="z-index: 1500;">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center text-light" id="bd-theme"
        type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
        <i class="fa-solid fa-sun fs-5 me-2 light d-none"></i>
        <i class="fa-solid fa-moon fs-5 me-2 dark d-none"></i>
        <i class="fa-solid fa-circle-half-stroke auto fs-5 me-2"></i>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                aria-pressed="false">
                <i class="fa-solid fa-sun fs-5 me-2"></i>
                Light
                <i class="fa-solid fa-check fa-xs ms-auto d-none"></i>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                aria-pressed="false">
                <i class="fa-solid fa-moon fs-5 me-2"></i>
                Dark
                <i class="fa-solid fa-check fa-xs ms-auto d-none"></i>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                aria-pressed="true">
                <i class="fa-solid fa-circle-half-stroke fs-5 me-2"></i>
                Auto
                <i class="fa-solid fa-check fa-xs ms-auto d-none"></i>
            </button>
        </li>
    </ul>
</div>
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="/">{{ config('app.name', 'My POS') }}</a>

    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                aria-label="Toggle search">
                <i class="fa-solid fa-search" aria-hidden="true"></i>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </li>
    </ul>

    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
</header>