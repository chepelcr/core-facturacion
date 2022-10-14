<?php $modulos = getModulos()?>

<div class="row">
    <!-- Modulos del usuario -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Modulos de sistema</h3>
                    
                    <!-- Icono de modulo -->
                    <i class="fas fa-th"></i>
                </div>
            </div>

            <div class="card-body scroll_vertical">
                <div class="row">
                    <!-- Recorrer los modulos -->
                    <?php 
                        $cantidad_modulos = count((array)$modulos);
                        $modulos_recorridos = 0;

                        foreach($modulos as $modulo):
                        
                            $modulos_recorridos++;

                            echo '<!-- '.$modulo->nombre_modulo.' -->';
                            
                            switch ($cantidad_modulos) {
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
                                    if($modulos_recorridos <= 3)
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
                                    if($modulos_recorridos <= 5)
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
                                        <?= $modulo->nombre_vista?>
                                    </h3>
                                    <?php
                                        if($modulo->icono != 'walmart'):
                                    ?>
                                    <i class="fa-solid <?= $modulo->icono?>"></i>
                                    <?php
                                        else:
                                            echo icono('walmart.png', 'Walmart');
                                        endif;
                                    ?>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <!-- Boton para obtener el modulo de empresa -->
                                <button type="button" onclick="cargar_inicio_modulo('<?= $modulo->nombre_modulo?>', '<?= $modulo->nombre_vista?>')"
                                    class="btn btn-dark">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

    <!-- Reporte de ventas -->
    <div class="col-md-8" hidden>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Reporte de ventas</h3>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>