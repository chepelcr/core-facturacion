<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de costos | Login</title>

    <!-- Google Font : Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= getFile('dist/css/adminlte.min.css') ?>">
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="<?=getFile('dist/css/estilos.css')?>">
    <!-- Logo -->
    <link rel="icon" type="image/png" href="<?= getFile('dist/img/logo.png') ?>">
    <!-- Pace Style-->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/pace-progress/themes/center-radar.css') ?>">
</head>

<body class="hold-transition login-page bg-olive">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-dark bg-gradient-blue">
            <div class="card-header text-center">
                <img src="<?= getFile('dist/img/logo.png') ?>" width="100px">
            </div>

            <div class="card-body bg-secondary">
                <form id="frmLogin" method="post">
                    <p class="login-box-msg text-white">Inicio de sesion</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="persona@ejemplo.com" name="usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="********" name="contrasenia">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="fw-bold btn btn-warning w-100">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

            <div class="card card-footer bg-gradient-blue">
                <div class="row">
                    <div class="col-12">
                        <a role="button" href="<?= baseUrl('login/olvido')?>"
                            class="btn btn-block bg-danger fw-bold">Olvidé mi
                            contraseña</a>

                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= getFile('dist/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= getFile('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= getFile('dist/js/adminlte.min.js') ?>"></script>
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>
    <!-- Base -->
    <script src="<?= getFile('dist/js/base/base.js') ?>"></script>
    <!-- Pace -->
    <script src="<?= getFile('dist/plugins/pace-progress/pace.min.js') ?>"></script>

    <script type="text/javascript">
    $("#frmLogin").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/consultar",
            "method": "post",
            "data": $('#frmLogin').serialize(),
            "dataType": "json"
        }).done(function(response) {
            switch (response.estado) {
                case '1':
                    location.reload();
                break;

                //Si la contrasenia ya expiro
                case '2':
                    //Envia mensaje de error al usuario
                    Swal.fire({
                        title: 'Atencion',
                        text: response.error,
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false
                    }).then((result) => {
                        //Redirecciona a la pagina de cambio de contraseña
                        location.reload();
                    });
                break;

                default:
                    Swal.fire({
                        title: 'Atencion',
                        text: response.error,
                        icon: 'warning',
                        timer: 2000,
                        showConfirmButton: false
                    });
                break;
            } //Fin switch
        }); //Fin del ajax
    }); //Fin del submit
    </script>
</body>

</html>