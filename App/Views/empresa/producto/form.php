<div class="row">
    <!-- Id del producto -->
    <input type="number" hidden id="id_producto" name="id_producto">
    <!-- Datos generales -->
    <div class="col-md-12">
        <?= view('empresa/producto/datos_generales', array(
                                        'categorias'=>$categorias,
                                        'unidades'=>$unidades,
        ))?>
    </div>

    <!-- Codigos -->
    <div class="col-md-7">
        <?= view('empresa/producto/codigos')?>
    </div>

    <!-- Hacienda -->
    <div class="col-md-5">
        <?= view('empresa/producto/hacienda')?>
    </div>

    <!-- Comercial-->
    <div class="col-md-12">
        <?= view('empresa/producto/valor')?>
    </div>
</div>