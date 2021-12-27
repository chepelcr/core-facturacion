<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">
                <?= ucwords(str_replace('_', ' ', $nombre_modulo))?>
            </h3>
            <i class="fas <?=$icono?>"></i>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <!--Recorrer submodulos -->
            <?php foreach($submodulos as $submodulo):
                        $nombre_submodulo = $submodulo->nombre_submodulo;
                        $icono = $submodulo->icono;
                        $url = $submodulo->url;
                        $acciones = $submodulo->acciones;
                    ?>
            <!-- <?=$nombre_submodulo?> -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">
                                <?=ucwords(str_replace('_', ' ', $nombre_submodulo))?>
                            </h3>
                            <i class="fas <?=$icono?>"></i>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <div class="d-flex justify-content-around">
                            <!-- Boton para entrar al modulo -->
                            <button class="btn btn-dark col-4"
                                onclick="cargar_listado('<?=$nombre_modulo?>', '<?=$nombre_submodulo?>', '<?= baseUrl($url)?>')">
                                Entrar
                            </button>

                            <!-- Recorrer las acciones -->
                            <?php foreach($acciones as $accion):
                                        $nombre_accion = $accion->nombre_accion;
                                        $icono = $accion->icono;

                                        if($nombre_accion == "insertar"):
                                    ?>
                            <!-- Boton para agregar un nuevo cliente -->
                            <button class="btn btn-dark col-4"
                                onclick="nuevo('<?=$nombre_modulo?>', '<?=$nombre_submodulo?>')"
                                id="#btn-agregar-cliente">
                                Crear
                            </button>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>