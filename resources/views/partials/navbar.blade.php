
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm"
     style="background: linear-gradient(90deg, #164B8C, #287BC1);">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <span class="me-2">📘</span>KursusKu
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">
                        Kursus
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('enrollments.create') }}">
                        Pendaftaran
                    </a>
                </li>

                @guest
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-light text-primary fw-semibold px-4"
                           href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            Profil
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link text-white">
                            Halo, {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="btn btn-light text-primary fw-semibold">
                                Logout
                            </button>
                        </form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
