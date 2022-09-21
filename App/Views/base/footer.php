<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        <strong><a href="<?=baseUrl()?>">Modas Laura &copy; | 2022</a></strong>
    </div>

    <!-- Default to the left -->
    <div class="row">
        <div class="col-1" data-toggle="tooltip" title="Tipo de cambio">
            <button type="button" class="btn btn-dark btn-block btn-sm float-right" onclick="obtener_tipo_cambio()">
                <i class="fas fa-dollar-sign"></i>
            </button>
        </div>

        <div class="col-2" data-toggle="tooltip" title="Compra">
            <!-- Compra -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <input class="form-control form-control-sm form-control-plaintext" value="0" disabled readonly id="tipo_compra">
            </div>
        </div>

        <div class="col-2" data-toggle="tooltip" title="Venta">
            <!-- Venta -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <input class="form-control form-control-sm form-control-plaintext" value="0" disabled readonly id="tipo_venta">
            </div>
        </div>
    </div>
</footer>