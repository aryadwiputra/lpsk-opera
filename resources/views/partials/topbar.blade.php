<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white md:py-3 color-landing">
    <div class="container">
        <a href="{{ route('landing.index') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light text-white">{{ config('app.name') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3 py-2" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a href="{{ route('landing.index') }}"
                        class="nav-link text-white {{ request()->routeIs('landing.index') ? 'active' : '' }}">Beranda</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('landing.front-peraturan') }}" class="nav-link text-white">Peraturan</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('landing.evaluation') }}"
                        class="nav-link text-white {{ request()->routeIs('landing.evaluation*') ? 'active' : '' }}">Analisis
                        dan Evaluasi</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('landing.public-participation') }}"
                        class="nav-link text-white {{ request()->routeIs('landing.public-participation*') ? 'active' : '' }}">Partisipasi
                        Publik</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>

                        <li class="dropdown-divider"></li>

                        <!-- Level two dropdown-->
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover
                                for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>

                                <!-- Level three dropdown-->
                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">level 2</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    </ul>
                                </li>
                                <!-- End Level three -->

                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                        </li>
                        <!-- End Level two -->
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
