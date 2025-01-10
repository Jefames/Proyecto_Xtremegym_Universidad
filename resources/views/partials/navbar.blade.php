<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{--            <li class="nav-item d-none d-sm-inline-block">--}}
        {{--                <a href="index3.html" class="nav-link">Home</a>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item d-none d-sm-inline-block">--}}
        {{--                <a href="#" class="nav-link">Contact</a>--}}
        {{--            </li>--}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{asset('assets/admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-32 mr-3 img-circle">
                {{ Auth::user()->name }}
                <i class="fas fa-sort-down"></i>
                {{--                    <span class="badge badge-danger navbar-badge">3</span>--}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                {{--                    <a href="#" class="dropdown-item">--}}
                {{--                        <!-- Message Start -->--}}
                {{--                        <div class="media">--}}
                {{--                            <div class="media-body">--}}
                {{--                                <h3 class="dropdown-item-title">--}}
                {{--                                    Brad Diesel--}}
                {{--                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
                {{--                                </h3>--}}
                {{--                                <p class="text-sm">Call me whenever you can...</p>--}}
                {{--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- Message End -->--}}
                {{--                    </a>--}}

                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-footer" style="border: none; background: none; padding: 0; margin: 0;">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>

{{--                <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"> Cerrar Sesión</i></a>--}}
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{--            <li class="nav-item">--}}
        {{--                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">--}}
        {{--                    <i class="fas fa-th-large"></i>--}}
        {{--                </a>--}}
        {{--            </li>--}}
    </ul>
</nav>
