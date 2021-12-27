<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <?php
        echo view('base/head');
    ?>

</head>

<body class="hold-transition layout-fixed layout-footer-fixed layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <?php
            $modulos = getModulos();

            echo view('base/nav', array('modulos'=>$modulos));

            //echo view('base/sidebar', array('modulos'=>$modulos));
         ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?=view('base/header');?>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="inicio">
                            <?php
                                echo view('inicio/dash', array('modulos'=>$modulos));
                            ?>
                        </div>

                        <div class="col-md-12">
                            <!-- Recorre submodulos y cargar modulo de inicio y barra de navegacion -->
                            <?php
                                foreach ($modulos as $modulo) {
                                    $nombre_modulo = $modulo->nombre_modulo;
                            ?>

                            <div class="contenedor" id="contenedor_<?=$nombre_modulo?>">
                                <?php 
                                    if($modulo->nombre_modulo != 'documentos')
                                        echo view('base/inicio_modulo', $modulo);

                                    else
                                        echo view('inicio/documentos');
                                ?>
                            </div>

                            <?php } ?>
                        </div>


                        <div class="col-md-12">
                            <div class="card card-body contenedor" id="contenedor">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <?= view('base/persona/perfil', array('perfil'=> getPerfil()))?>

        <!-- Main Footer -->
        <?php echo view('base/footer')?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php 
        if(isset($script))
        {
            $data = array(
                'script'=>$script
            );
    
            echo view('base/script', $data);
        }

        else
            echo view('base/script');
    ?>
</body>

</html>