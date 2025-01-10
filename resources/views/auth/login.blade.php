<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SPORTGYM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">

    <style>
        #boton_ojito {
            display: none; /* Oculta el botón inicialmente */
        }
    </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="logo">
        </div>
        <div class="card-body">

            <p class="login-box-msg">
                <b>Accede a tu cuenta</b> <br>
                Ingresa tu usuario y contraseña para continuar
            </p>
            <form action="{{url('login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cod_user" placeholder="Ingresa tu usuario..." id="usuario" pattern="\d*" title="Solo se permiten números" required>
            <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña..." required>
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="boton_ojito">
                            <span class="fas fa-eye" id="togglePasswordIcon"></span>
                        </button>
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                </div>
                <!-- /.col -->
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- JS PROPIO -->
<script src="{{asset('assets/js/login/login.js')}}"></script>

</body>
</html>
