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

<body class="hold-transition layout-fixed layout-footer-fixed layout-top-nav">
    <div class="wrapper">

        <!-- Preloader -->
        <!--<div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?=baseUrl('files/dist/img/logo.png')?>" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <?= view('base/nav', array('modulos'=>$modulos))?>

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
                                //var_dump($nombre_modulo);
                                    if($modulo->nombre_modulo != 'documentos')
                                    {
                                        echo view('base/modal/modulo', $modulo);

                                        //Recorrer submodulos
                                        foreach($modulo->submodulos as $submodulo):
                                            $submodulo->nombre_modulo = $modulo->nombre_modulo;

                                            //var_dump($submodulo);

                                            echo view('base/modal/submodulo', $submodulo);
                                        endforeach;
                                    }

                                    else
                                    {
                                        echo view('inicio/'.$modulo->nombre_modulo, $modulo);
                                    }
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

        <!-- Perfil del usuario que ha iniciado sesion -->
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