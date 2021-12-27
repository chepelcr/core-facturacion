<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-modas navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav col-8 justify-content-between">
        <a href="../../index3.html" class="navbar-brand">
            <img src="<?=getFile('dist/img/logo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Modas Laura</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Inicio -->
        <li class="nav-item">
            <button class="btn btn-secondary nav-modulo nav-inicio"
                data-toggle="tooltip" title="Inicio" onclick="cargar_inicio()" type="button">
                <i class="fas fa-home nav-icon"></i>
            </button>
        </li>

        <!-- Modulos -->
        <?php foreach ($modulos as $modulo):
            $nombre_modulo = $modulo->nombre_modulo;
            $icono = $modulo->icono;
            $submodulos = $modulo->submodulos;

            if($nombre_modulo != 'documentos'):
        ?>

        <li class="nav-item dropdown">
            <button class="btn btn-secondary nav-modulo nav-<?=$nombre_modulo?>"
                data-toggle="tooltip" title="<?=ucwords(str_replace('_', ' ', $nombre_modulo))?>"
                onclick="cargar_inicio_modulo('<?php echo $modulo->nombre_modulo?>')" type="button">
                <i class="fa <?=$icono?> nav-icon"></i>
            </button>

            <button type="button" class="btn btn-danger nav-menu dropdown-toggle dropdown-toggle-split nav-menu-<?=$nombre_modulo?>"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>

            <div class="dropdown-menu dropdown-menu-left bg-transparent border-0 shadow-none" aria-labelledby="nav-<?=$nombre_modulo?>">
                <?php foreach ($submodulos as $submodulo):
                        $nombre_submodulo = $submodulo->nombre_submodulo;
                        $icono = $submodulo->icono;
                        $url = $submodulo->url;
                    ?>
                <div class="p-1">
                    <button data-toggle="tooltip" title="<?=ucwords(str_replace('_', ' ', $nombre_submodulo))?>" class="w-50 btn btn-dark nav-button btn_<?=$nombre_modulo.'_'.$nombre_submodulo?>"
                        onclick="cargar_listado('<?=$nombre_modulo?>', '<?=$nombre_submodulo?>', '<?=baseUrl($url)?>')">
                        <i class="fa <?=$icono?>"></i>
                    </button>
                </div>
                <?php endforeach;?>
            </div>
        </li>

        <?php
            else:
        ?>

        <li class="nav-item">
            <button class="btn btn-secondary nav-modulo nav-<?=$nombre_modulo?>"
                data-toggle="tooltip" title="Facturacion"
                onclick="cargar_inicio_modulo('<?php echo $modulo->nombre_modulo?>')" type="button">
                <i class="fa <?=$icono?> nav-icon"></i>
            </button>
        </li>

        <?php
            endif;
            endforeach;
        ?>
    </ul>

    <!-- Recorrer los submodulos -->
    <?php
        foreach ($modulos as $modulo):
            $nombre_modulo = $modulo->nombre_modulo;
            $icono = $modulo->icono;
            $submodulos = $modulo->submodulos;

            foreach ($submodulos as $submodulo) {
                $nombre_submodulo = $submodulo->nombre_submodulo;
                $objeto = $submodulo->objeto;
                $acciones = $submodulo->acciones;
                
                foreach ($acciones as $accion):
                    $nombre_accion = $accion->nombre_accion;

                    if($nombre_accion == 'insertar'):
            ?>
    <ul class="navbar-nav ml-auto col-2 justify-content-center agregar agregar_<?=$nombre_modulo.'_'.$nombre_submodulo?>">
        <button type="button" data-toggle="tooltip" title="Agregar <?= $objeto?>"
            onclick="agregar('Agregar <?=$objeto?>', 'modalAccion', true)" class="btn btn-danger">
            <i class="fas <?=$accion->icono?>"></i>
        </button>
    </ul>
    <?php endif; endforeach; } endforeach; ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto justify-content-around col-2">
        <!-- Perfil -->
        <li class="nav-item">
            <button class="btn btn-secondary" data-toggle="tooltip" title="Perfil" onclick="abrir_perfil()"
                type="button">
                <i class="fas fa-user-circle nav-icon"></i>
            </button>
        </li>

        <!-- Salir -->
        <li class="nav-item">
            <button class="btn btn-secondary" data-toggle="tooltip" title="Salir" onclick="salir()" type="button">
                <i class="fas fa-sign-out-alt nav-icon"></i>
            </button>
        </li>
    </ul>
</nav>
<!-- /.navbar -->