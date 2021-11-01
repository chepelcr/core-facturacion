<aside class="main-sidebar sidebar-dark-primary bg-modas elevation-4">
    <!-- Brand Logo -->
    <a href="<?=baseUrl()?>" class="brand-link">
        <img src="<?=getFile('dist/img/logo.png')?>" alt="Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sitema de ordenes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=getFile('dist/img/logo.png')?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">José Pablo</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <?php
                    echo view('sidebar/dashboard');

                    $modulos = getModulos();

                    foreach ($modulos as $nombre_modulo => $submodulos) {
                        echo view('sidebar/'.$nombre_modulo, array('submodulos'=>$submodulos));
                    }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>