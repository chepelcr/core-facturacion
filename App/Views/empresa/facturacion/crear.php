<form id="frmFacturar">
    <input hidden value="<?=$id_tipo_documento?>" name="id_tipo_documento" type="text">
    <div class="row">
        <!--Columna izquierda-->
        <div class="col-md-7">
            <!-- Encabezado -->
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="card-title">Encabezado</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Seleccionar cliente -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                                        <option value="">Selecionar Cliente</option>
                                        <?php foreach ($clientes as $key => $cliente): ?>
                                        <option value="<?=$cliente->id_cliente?>"><?=$cliente->razon?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tipo de cambio-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                    </div>
                                    <select class="form-control" id="moneda" name="moneda" required>
                                        <option value="">Moneda</option>
                                        <option value="CRC">Colones</option>
                                        <option value="USD">Dolares</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                    </div>
                                    <input class="form-control" id="tipo_cambio" name="tipo_cambio" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cash-register"></i></span>
                                    </div>
                                    <select class="form-control" id="medio_pago" name="medio_pago" required>
                                        <option value="">Medio de Pago</option>
                                        <option value="01">Efectivo</option>
                                        <option value="04">Transferencia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-handshake"></i></span>
                                    </div>
                                    <select class="form-control" id="condicion_venta" name="condicion_venta" required>
                                        <option value="">Condicion Venta</option>
                                        <option value="01">Contado</option>
                                        <option value="02">Credito 30 dias</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <!-- Agregar un articulo-->
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="card-title">Agregar Artículo</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <!-- Codigo de barras -->
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <input class="form-control form-control-lg inp"
                                                placeholder="Código de barras" id="gnl" max="13">

                                            <!-- Buscar articulo -->
                                            <div class="input-group-append">
                                                <button class="btn" type="button" data-toggle="modal"
                                                    data-target="#modalBusqueda">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="w-100 btn btn-primary btt-grd">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha-->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="card-title">Detalles del documento</h5>
                    <button type="button" class="btn btn-secondary float-right btn-sm agregarLinea">
                        <i class="fas fa-plus"></i> Agregar Linea</button>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-2">Codigo</th>
                                    <th class="col-5">Descripcion</th>
                                    <th hidden>Unid</th>
                                    <th class="col-1">Cantidad</th>
                                    <th hidden>Precio</th>
                                    <th hidden>Neto</th>
                                    <th hidden>Monto Desc.</th>
                                    <th hidden>Subtotal</th>
                                    <th hidden>Imp %</th>
                                    <th hidden>Monto Imp.</th>
                                    <th class="col-2">Total Linea</th>
                                    <th class="col-2"></th>
                                </tr>
                            </thead>

                            <tbody id="tblDetalles">
                                <tr id="linea1" class="linea">
                                    <td colspan="5">
                                        <div class="row">
                                            <div class="col-2">
                                                <input class="form-control codigo" type="text" name="codigo[]" required>
                                            </div>

                                            <div class="col-5">
                                                <input class="form-control descripcion" type="text" name="detalle[]"
                                                    required>
                                            </div>

                                            <div hidden>
                                                <input value="Unid" class="form-control unidad" name="unidad[]">
                                            </div>

                                            <div class="col-1">
                                                <input value="0" class="form-control cantidad calcular" min="0"
                                                    step="0.01" type="number" name="cantidad[]" required>
                                            </div>

                                            <div hidden>
                                                <input value="0" class="form-control precio calcular" min="0" type=""
                                                    name="precio_unidad[]" required>
                                            </div>

                                            <div hidden>
                                                <input value="0" class="form-control neto" type="number"
                                                    name="monto_total[]" readonly required>
                                            </div>

                                            <div hidden>
                                                <input value="0" class="form-control descM" type="number"
                                                    name="monto_descuento[]" readonly required>
                                            </div>

                                            <div hidden>
                                                <input value="0" class="form-control subtotal" type="number"
                                                    name="sub_total[]" readonly required>
                                            </div>

                                            <div hidden>
                                                <input class="form-control impP" type="number" name="tarifa[]" required>
                                            </div>

                                            <div hidden>
                                                <input value="0" class="form-control impM" type="number" readonly
                                                    name="monto_impuesto[]" required>
                                            </div>

                                            <div class="col-2">
                                                <input value="0" class="form-control totalL" type="number" readonly
                                                    name="total_linea[]" required>
                                            </div>

                                            <div class="col-2 text-center">
                                                <button class="btn btn-primary descB" type="button"
                                                    data-toggle="collapse" aria-expanded="false" value="0"
                                                    aria-controls="descuento">
                                                    <i class="fas fa-percent"></i>
                                                </button>

                                                <button type="button" value="0" class="btn btn-danger eliminarLinea"
                                                    hidden>
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="collapse l_desc" id="descuento0">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <!-- Descuento-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fas fa-money-bill"></i></span>
                                                                        </div>
                                                                        <input class=" mot form-control"
                                                                            id="motivo_descuento"
                                                                            name="motivo_descuento[]"
                                                                            placeholder="Motivo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-hand-holding-usd"></i>
                                                                            </span>
                                                                        </div>

                                                                        <input class="form-control descP calcular"
                                                                            max="15" min="0" type="number" value="0">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot class="table-sm sinBorde">
                                <tr>
                                    <td colspan="3" align="right">Neto</td>
                                    <td colspan="2" align="right" class="lblNeto">0</td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Descuentos</td>
                                    <td colspan="2" align="right" class="lblDescuentos">0</td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Subtotal</td>
                                    <td colspan="2" align="right" class="lblSubtotal">0</td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">IVA</td>
                                    <td colspan="2" align="right" class="lblIVA">0</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" name="notas" placeholder="Observaciones"
                                            class="form-control bg-gray color-palette text-white"></td>
                                    <td align="right">Total</td>
                                    <td colspan="2" align="right" class="lblTotal">0</td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <button id="btnGenerarFactura" type="submit" class="btn btn-success"> <i
                                    class="fas fa-check-circle"></i> Generar Documento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php echo view('documentos/modalArticulo')?>