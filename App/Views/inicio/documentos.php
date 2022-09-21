<div class="row">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <?= view('facturacion/elementos/nav')?>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="listado_documentos">
                    </div>

                    <div class="col-md-12 contenedor_facturas">
                        <div class="card">
                            <div class="card-body scroll_vertical" id="contenedor_facturas" style="max-height: 350px;">

                            </div>

                            <div class="card-footer">
                                <div class="row d-flex justify-content-between">
                                    <!-- Tipos de documentos -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- Select con los tipos de documentos -->
                                            <select class="form-control form-control-sm tipo_documento" disabled id="q_documento">
                                                <option value="">Tipo de documento</option>
                                                <!-- Recorrer tipos de documentos -->
                                                <?php foreach ($tipos_documentos as $tipo_documento): ?>
                                                    <option value="<?php echo $tipo_documento->id_tipo_documento; ?>">
                                                        <?php echo $tipo_documento->descripcion; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <!-- Codigo de barras -->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>

                                            <input class="form-control form-control-sm gnl-agregar" type="text" id="q_codigo_barras"
                                                placeholder="Ingrese código de barras">

                                            <!-- Buscar articulo -->
                                            <div class="input-group-append">
                                                <button class="btn btn-buscar-prod" type="button" data-toggle="tooltip"
                                                    title="Buscar producto" onclick="buscar_producto(this, '', true)">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1">
        <div class="d-flex align-items-start flex-column bd-highlight mb-3 h-100">
            <div class="mb-auto pl-2 pr-2 bd-highlight w-100">
                <?php 
                    echo view('facturacion/elementos/agregar');

                    echo view('facturacion/elementos/opciones');
                ?>
            </div>
            <div class="pl-2 pr-2 bd-highlight w-100">
                <?php 
                    echo view('facturacion/elementos/finalizar');
                ?>
            </div>

            <div class="pl-2 pr-2 bd-highlight cont-reporte w-100">
                <?php 
                    echo view('facturacion/elementos/reporte');
                ?>
            </div>
        </div>
    </div>
</div>

<div id="contenedor_pdf">
</div>

<?php 
    echo view('facturacion/modal/productos'); 
    
    echo view('facturacion/modal/clientes', getInfoClientes());
?>