<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modas Laura | Login</title>

    <!-- Google Font : Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Logo -->
    <link rel="icon" type="image/png" href="<?= getFile('dist/img/logo.png') ?>">
    <!-- Pace Style-->
    <link rel="stylesheet" href="<?= getFile('dist/plugins/pace-progress/themes/center-radar.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= getFile('dist/css/adminlte.min.css') ?>">
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="<?=getFile('dist/css/estilos.css')?>">
</head>

<body class="hold-transition login-page bg-olive">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-dark bg-gradient-blue">
            <div class="card-header text-center">
                <img src="<?= getFile('dist/img/logo.png') ?>" width="100px">
            </div>

            <form id="frm_contrasenia" method="post">
                <div class="card-body bg-secondary">

                    <p class="login-box-msg text-white">Cambio de contraseña</p>
                    <?= view('seguridad/perfil/contrasenia')?>

                </div>
                <!-- /.card-body -->

                <div class="card card-footer bg-gradient-blue">
                    <div class="row">
                        <div class="col-3 text-center">
                            <!-- Salir -->
                            <button class="btn btn-secondary btn-block" data-toggle="tooltip" title="Salir"
                                onclick="salir()" type="button">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </div>
                        <!-- /.col -->

                        <div class="col-9">
                            <button type="submit" class="fw-bold btn btn-danger btt-grd btn-block">Aceptar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.card-footer-->
            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>
    <!-- Pace -->
    <script src="<?= getFile('dist/plugins/pace-progress/pace.min.js') ?>"></script>

    <!-- Base | Mensajes -->
    <?=getScript('base/mensajes')?>

    <!-- Base | Login -->
    <?=getScript('base/login')?>

    <!-- Seguridad | Contrasenia-->
    <?=getScript('seguridad/contrasenia')?>
</body>

</html>