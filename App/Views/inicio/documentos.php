<div class="row">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 bg-gradient-gray rounded">
                        <div class="row" id="nav-facturacion">
                            <div class="col col-md-4 col-lg col-md col-sm p-1">
                                <button class="btn btn-dark nav-button w-100 btn-documentos" type="button"
                                    onclick="cargar_documentos()">
                                    Documentos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body scroll_vertical">
                <div class="row">
                    <div class="col-md-12" id="listado_documentos">
                    </div>

                    <div class="col-md-12" id="contenedor_facturas">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1">
        <div class="card card-opciones">
            <div class="card-header">
                <h3 class="card-title w-100">
                    <!--Crear venta -->
                    <button data-toggle="tooltip" title="Venta rapida" class="btn btn-dark nav-button w-100 btn-crear-venta"
                        type="button" onclick="agregar_documento('tiquete')">
                        <i class="fas fa-plus"></i>
                    </button>
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Factura -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100" title="Crear factura" data-toggle="tooltip"
                            onclick="agregar_documento('factura')">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </button>
                    </div>

                    <!-- Nota de credito -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100" title="Crear nota de crédito" data-toggle="tooltip"
                            onclick="agregar_documento('nota_credito')">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </button>
                    </div>

                    <!-- Nota de debito -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100" title="Crear nota de débito" data-toggle="tooltip"
                            onclick="agregar_documento('nota_debito')">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-opciones-documentos">
            <div class="card-body">
                <div class="row">
                    <!-- Cliente -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100 btn-cliente" title="Agregar Cliente" data-toggle="tooltip"
                            onclick="ver_modal_cliente()">
                            <i class="fas fa-user"></i>
                        </button>
                    </div>

                    <!-- Referencias -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100 btn-referencia" title="Agregar Referencia" data-toggle="tooltip"
                            onclick="agregar_referencia()">
                            <i class="fas fa-clipboard-list"></i>
                        </button>
                    </div>

                    <!-- Inventario -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100 btn-inventario" title="Ver Inventario" data-toggle="tooltip"
                            onclick="ver_inventario()">
                            <i class="fas fa-box-open"></i>
                        </button>
                    </div>

                    <!-- Walmart -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-dark w-100 btn-walmart" title="Datos Walmart" data-toggle="tooltip"
                            onclick="ver_walmart()">
                            <!-- Icono con imagen personalizada -->
                            <img src="<?=getFile('dist/img/walmart.png') ?>" alt="Walmart" class="img-fluid icn">
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <!-- Guardar -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-success w-100" title="Guardar" data-toggle="tooltip" onclick="finalizar_documento()">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>

                    <!-- Cancelar -->
                    <div class="col-md-12 p-1">
                        <button class="btn btn-danger w-100" title="Cancelar" data-toggle="tooltip" onclick="cancelar_documento()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="contenedor_pdf">
    </div>
</div>

<?= view('facturacion/modalArticulo'); ?>

