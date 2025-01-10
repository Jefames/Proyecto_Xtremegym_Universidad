<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('assets/img/icon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light "><b>EXTREME GYM</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">USUARIO</a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                     @if(auth()->user()->rol == 'Administrador')
                <li class="nav-item">
                    <a href="{{ route('asistencias.grafica') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
{{--                        <i class="nav-icon fas fa-th-large"></i>--}}
                        <p>
                            Estadisticas
{{--                            <i class="right fas fa-angle-left"></i>--}}
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-header">MENU</li>
                {{-- NUEVO EXPEDIENTE / CREACION DE UN NUEVO EXPEDIENTE DE UN SERVICIO EJEMPLO: CENTRO DE LLAMADAS --}}
                <li class="nav-item">
                    <a href="{{ route('notificaciones.asist') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Asistencia
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('notificaciones.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notificaciones
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('clientes.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Nuevo Cliente
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Consulta Clientes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                        <a href="{{ route('suscripciones.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-plus"></i>
                        <p>
                            Suscripciones
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('suscripciones.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Consulta Suscripciones
                        </p>
                    </a>
                </li>
                @if(auth()->user()->rol == 'Administrador')
                <li class="nav-item">
                    <a href="{{ route('pagos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            PAGOS
                        </p>
                    </a>
                </li>

               
                <li class="nav-header">ADMIN</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>

                <li class="nav-header">CATALOGO</li>
                <li class="nav-item">
                    <a href="{{ route('membresias.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p>
                            Membresias
                        </p>
                    </a>
                </li>
                @endif

            </ul> {{-- CIERRE DEL SIDEBAR OPCIONES--}}
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
