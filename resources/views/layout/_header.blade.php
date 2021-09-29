<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('asset') }}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home.index')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('company.index')}}" class="nav-link">Companies</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('employee.index')}}" class="nav-link">Employees</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            @auth
                <a class="nav-link">{{Auth::user()->name}}</a>
            @endauth
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            @auth
                <a href="{{route('admin_logout')}}" class="nav-link">Logout</a>
            @endauth
        </li>
    </ul>
</nav>

