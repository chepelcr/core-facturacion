<div class="modal fade" id="modal-<?=$nombre_modulo?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title">
                <?php
                    if($icono != 'walmart'):
                ?>
                <i class="fa-solid <?= $icono?>"></i>
                <?php
                    else:
                        echo icono('walmart.png', 'Walmart');
                    endif;
                ?>
                    <?=$nombre_vista?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" onclick="cargar_inicio()" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="container">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-around">
                            <!--Recorrer submodulos -->
                            <?php 

                            $cantidad_submodulos = count((array) $submodulos);
                                            
                            $submodulos_recorridos = 0;

                            foreach($submodulos as $submodulo):
                                $nombre_submodulo = $submodulo->nombre_submodulo;
                                $nombre_vista = $submodulo->nombre_vista;
                                $icono = $submodulo->icono;
                                $url = $submodulo->url;
                                $acciones = $submodulo->acciones;

                                $submodulos_recorridos++;

                                echo '<!-- '.$nombre_submodulo.' -->';

                                switch ($cantidad_submodulos) {
                                    case '1':
                                        echo '<div class="col-md-12">';
                                        break;

                                    case '2':
                                        echo '<div class="col-md-6">';
                                        break;

                                    case '3':
                                        echo '<div class="col-md-4">';
                                        break;

                                    case '4':
                                        echo '<div class="col-md-3">';
                                        break;

                                    case '5':
                                        if($submodulos_recorridos <= 3)
                                        {
                                            echo '<div class="col-md-4">';
                                        }
                                        else
                                        {
                                            echo '<div class="col-md-6">';
                                        }
                                        break;

                                    case '6':
                                        echo '<div class="col-md-4">';
                                        break;

                                    case '7':
                                        if($submodulos_recorridos <= 5)
                                        {
                                            echo '<div class="col-md-3">';
                                        }
                                        else
                                        {
                                            echo '<div class="col-md-6">';
                                        }
                                        break;
                                }
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">
                                                <?=$nombre_vista?>
                                            </h3>

                                            <?php
                                                if($nombre_modulo == 'walmart' && $nombre_submodulo == 'ordenes'):
                                            ?>
                                                <i class="fa-brands <?=$icono?>"></i>
                                            <?php
                                                else:
                                            ?>
                                                <i class="fa-solid <?=$icono?>"></i>
                                            <?php
                                                endif;
                                            ?>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-8">
                                                <!-- Boton para entrar al modulo -->
                                                <button class="btn btn-info btn-block" data-toggle="tooltip"
                                                    title="Ir a <?=$nombre_vista?>"
                                                    onclick="cargar_listado('<?=$nombre_modulo?>', '<?=$nombre_submodulo?>', '<?= baseUrl($url)?>')">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- Fin de recorrer submodulos -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>