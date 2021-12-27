<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                        echo view('facturacion/nav', array('submodulo'=>'facturacion'));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?= view('facturacion/listado', array('documentos'=>$documentos))?>
    </div>

    <div class="col-md-12" id="facturacion">
    </div>

    <div class="col-md-12">
        <?=view('facturacion/cliente', $dataClientes)?>
    </div>
</div>

<?php 
    echo view('facturacion/modalArticulo', $dataArticulos);
?>