<?php
if (count((array) $submodulos) > 0) :
?>
    <li class="nav-item dropdown p-1" id="nav-<?= $nombre_modulo ?>">
        <a class=" btn btn-secondary justify-content-around nav-modulo nav-<?= $nombre_modulo ?>" href="#" role="button" data-toggle="tooltip" title="<?= $nombre_vista ?>" onclick="cargar_inicio_modulo('<?= $nombre_modulo ?>')">
            <?php
            if ($icono != 'walmart') :
            ?>
                <i class="fa-solid <?= $icono ?> nav-icon"></i>
            <?php
            else :
                echo icono('walmart.png', 'Walmart', 'nav-icon');
            endif;
            ?>

            <span class="">
                <?= $nombre_vista ?>
            </span>
        </a>

        <a class="btn btn-danger nav-menu dropdown-toggle dropdown-toggle-split nav-menu-<?= $nombre_modulo ?>" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </a>

        <div class="dropdown-menu drp-nav dropdown-menu-left bg-transparent border-0 shadow-none" aria-labelledby="nav-<?= $nombre_modulo ?>">
            <?php
            foreach ($submodulos as $submodulo) :
                $nombre_submodulo = $submodulo->nombre_submodulo;
                $nombre_vista_submodulo = $submodulo->nombre_vista;
                $icono = $submodulo->icono;
                $url = $submodulo->url;

                if ($nombre_modulo != 'documentos') :
                    if (validar_permiso($nombre_modulo, $nombre_submodulo, 'consultar')) :
            ?>
                        <div class="p-1">
                            <button data-toggle="tooltip" title="<?= $nombre_vista_submodulo ?>" class="btn btn-block btn-dark nav-button btn_<?= $nombre_modulo . '_' . $nombre_submodulo ?>" onclick="cargar_listado('<?= $nombre_modulo ?>', '<?= $nombre_submodulo ?>', '<?= $nombre_vista ?>', '<?= $nombre_vista_submodulo ?>', '<?= baseUrl($url) ?>')">
                                <i class="fa-solid <?= $icono ?>"></i>
                            </button>
                        </div>
                    <?php
                    endif;

                else :
                    if ($nombre_submodulo != 'importar') :
                    ?>
                        <div class="p-1">
                            <button data-toggle="tooltip" title="<?= $nombre_vista_submodulo ?>" class="btn btn-block btn-dark nav-button btn_<?= $nombre_modulo . '_' . $nombre_submodulo ?>" onclick="cargar_documentos('<?= $nombre_submodulo ?>')">
                                <i class="fa-solid <?= $icono ?>"></i>
                            </button>
                        </div>
                    <?php
                    else :
                    ?>
                        <div class="p-1">
                            <button data-toggle="tooltip" title="<?= $nombre_vista_submodulo ?>" class="btn btn-block btn-dark nav-button btn_<?= $nombre_modulo . '_' . $nombre_submodulo ?>" onclick="importar_documentos()">
                                <i class="fa-solid <?= $icono ?>"></i>
                            </button>
                        </div>
            <?php
                    endif;
                endif;
            endforeach;
            ?>
        </div>


    </li>

<?php
else :
?>

    <li class="nav-item">
        <button class="btn btn-secondary nav-modulo nav-<?= $nombre_modulo ?>" data-toggle="tooltip" title="<?= $nombre_vista ?>" onclick="cargar_inicio_modulo('<?= $nombre_modulo ?>')" type="button">
            <i class="fa <?= $icono ?> nav-icon"></i>
        </button>
    </li>

<?php
endif;
?>