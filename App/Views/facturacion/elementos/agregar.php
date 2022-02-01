<div class="card card-opciones">
    <div class="card-header">
        <div class="row">
            <div class="col-md-12 col-opciones">
                <!--Crear venta -->
                <button data-toggle="tooltip" title="Venta rapida" class="btn btn-dark btn-block" type="button"
                    onclick="agregar_documento('tiquete')">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-opciones">
                <!-- Factura -->
                <button class="btn bg-gradient-olive btn-block" title="Crear factura" data-toggle="tooltip"
                    onclick="agregar_documento('factura')">
                    <i class="fas fa-receipt"></i>
                </button>

                <!-- Nota de credito -->
                <button class="btn bg-gradient-danger btn-block" title="Crear nota de crédito" data-toggle="tooltip"
                    onclick="agregar_documento('nota_credito')">
                    <i class="fas fa-funnel-dollar"></i>
                </button>

                <!-- Nota de debito -->
                <button class="btn bg-gradient-warning btn-block" title="Crear nota de débito" data-toggle="tooltip"
                    onclick="agregar_documento('nota_debito')">
                    <i class="fas fa-coins"></i>
                </button>
            </div>
        </div>
    </div>
</div>