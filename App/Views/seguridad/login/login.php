<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturacion | Login</title>

    <!-- Google Font : Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
        href="<?= getFile('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= getFile('dist/css/adminlte.min.css')?>">
    <!-- Logo -->
    <link rel="icon" type="image/png" href="<?= getFile('dist/img/logo.png')?>">
    <!-- Pace Style-->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/pace-progress/themes/center-radar.css')?>">
</head>

<body class="hold-transition login-page bg-primary">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center bg-dark">
                <img src="<?= getFile('dist/img/logo.png')?>" width="100px">
            </div>

            <div class="card-body bg-secondary">
                <form id="frmLogin" method="post">
                    <p class="login-box-msg text-white">Inicio de sesion</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Correo electronico" name="usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasenia">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Recuerdame
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

            <div class="card card-footer bg-info">
                <div class="text-left">
                    <p class="mb-0">
                        <a href="<?= baseUrl('login/olvido')?>"
                            class="text-center text-white">Olvidé mi contraseña?</a>
                    </p>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= getFile('dist/plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= getFile('dist/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= getFile('dist/js/adminlte.min.js')?>"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>
    <!-- Base -->
    <script src="<?= getFile('dist/js/base.js')?>"></script>
    <!-- Pace -->
    <script src="<?= getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

    <script type="text/javascript">
    var base = "http://localhost/facturacion/facturacion_servidor/public/";


    $("#frmLogin").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/consultar",
            "method": "post",
            "data": $('#frmLogin').serialize(),
            "dataType": "json"
        }).done(function(response) {
            if (response == 1) {
                window.location.href = base + "punto";
            }//Fin del if
            
            else {
                mensajeAutomatico('Atencion', 'Usuario o contraseña incorrectos', 'error');
            } //Fin del else
        }); //Fin del ajax
    }); //Fin del submit

    //Abrir el modal de registro de usuario cuando se le da click al boton de registrar
    $(document).on('click', '#registro', function() {
        //Mostrar el modal del usuario
        $('#modalUsuario').modal('show');
    });

    //Agregar un nuevo usuario
    $("#frmRegistro").on('submit', function(e) {
        e.preventDefault();

        Pace.track(function() {
            $.ajax({
                "url": base + "login/registro",
                "method": "post",
                "data": $('#frmRegistro').serialize(),
                "dataType": "json",
            }).done(function(response) {
                if (response == 0) {
                    mensajeAutomatico('Atencion',
                        'El correo indicado ya se encuentra registrado', 'error');
                } else {
                    if (response != -1) {
                        swal({
                            title: "Atencion",
                            text: 'Registro finalizado, revisa tu correo para finalizar',
                            icon: 'success',
                            timer: 4000
                        });

                        $("#modalUsuario").modal("hide");
                    } //Fin del if
                    else {
                        mensajeAutomatico('Atencion',
                            'Debes aceptar los terminos y condiciones', 'warning');
                    } //Fin del else
                } //Fin de la respuesta diferente de 0
            });//Fin del ajax
        });
    });
    </script>
</body>

</html>
