<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <?php
        if(isset($dataHead))
            echo view('base/head', $dataHead);

        else
            echo view('base/head');
    ?>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php
            echo view('base/nav');

            echo view('base/sidebar');
         ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            <?php
                if(isset($dataHeader))
                    echo view('base/header', $dataHeader);
            ?>

            <div class="container">
                <div class="container-fluid">
                    <?php
                        if(isset($dataView))
                            echo view($nombreVista, $dataView);
                
                        else 
                            echo view($nombreVista);
                    ?>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

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