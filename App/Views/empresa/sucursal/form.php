<div class="row">
    <input class="form-control form-control-lg inp" id="id_sucursal" name="id_sucursal" hidden type="number">

    <!-- Nombre de la sucursal -->
    <div class="col-md-8">
        <div class="form-group">
            <label class="text-left">Nombre de la sucursal</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input class="form-control form-control-lg inp" id="nombre_sucursal" name="nombre_sucursal" type="text"
                    required>
            </div>
        </div>
    </div>
    <!-- /Nombre de la sucursal -->

    <div class="col-md-4">
        <div class="form-group text-center">
            <!-- Nombre del autor -->
            <label for="estado">Activo</label>
            <div class="input-group">

                <input class="form-control form-control-lg inp" id="estado" name="estado" type="checkbox">
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?php
            echo view('base/provincias', $dataProvincias);
        ?>
    </div>
</div>