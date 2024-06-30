<?php $modulos = getModulos()?>

<div class="row">

    <!-- Recorrer los modulos -->
    <?php foreach($modulos as $modulo):?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?= ucwords(str_replace('_', ' ',$modulo->nombre_modulo))?>
                    </h3>
                    <i class=" fa <?php echo $modulo->icono?>"></i>
                </div>
            </div>

            <div class="card-body text-center">
                <!-- Boton para obtener el modulo de empresa -->
                <button type="button" onclick="cargar_inicio_modulo('<?php echo $modulo->nombre_modulo?>')"
                    class="btn btn-dark">
                    Entrar
                </button>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>