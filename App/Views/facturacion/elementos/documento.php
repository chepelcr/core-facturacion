<form class="card-factura" id="card-factura-<?=$numero_documento?>">
    <div class="row table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th class="col-3">Codigo</th>
                    <th class="col-4">Descripcion</th>
                    <th class="col-3">Cantidad</th>
                    <th hidden>Valor Unitario</th>
                    <th hidden>Monto Neto</th>
                    <th hidden>Monto Desc.</th>
                    <th hidden>Imp %</th>
                    <th hidden>Monto Imp.</th>
                    <th hidden>Subtotal</th>
                    <th class="col-1">Total Linea</th>
                    <th class="col-1">Opciones</th>
                </tr>
            </thead>

            <tbody class="tblDetalles">
                <tr class="linea">
                    <td colspan="6">
                        <div class="row">
                            <div hidden>
                                <input class="form-control codigo inp-fct" type="text" name="codigo[]">
                            </div>

                            <div class="col-3">
                                <div class="input-group">
                                    <!-- Codigo de barras -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>

                                    <input class="form-control inp-fct gnl" type="number" min="0" name="gnl[]"
                                        placeholder="Código de barras">

                                    <!-- Buscar articulo -->
                                    <div class="input-group-append">
                                        <button class="btn btn-buscar-prod" type="button" data-toggle="tooltip"
                                            title="Buscar producto" onclick="buscar_producto(this)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <input class="form-control descripcion inp-fct" type="text" name="detalle[]" readonly
                                    disabled required>
                            </div>

                            <div class="col-1">
                                <input value="0" class="form-control cantidad calcular inp-fct" min="0" type="number"
                                    name="cantidad[]" required>
                            </div>

                            <div class="col-2">
                                <select name="unidad[]" class="unidad form-control inp-fct" disabled>
                                    <!-- Recorrer unidades de medida -->
                                    <?php foreach ($unidades_medida as $unidad): ?>
                                    <option value="<?= $unidad->simbolo ?>"
                                        <?php if($unidad->id_unidad == 85 ) echo 'selected'?>>
                                        <?= $unidad->descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div hidden>
                                <input value="0" class="form-control precio calcular inp-fct" min="0" type="number"
                                    name="precio_unidad[]">
                            </div>

                            <div hidden>
                                <input value="0" class="form-control neto inp-fct" type="number" name="monto_total[]"
                                    required>
                            </div>

                            <div hidden>
                                <input value="0" class="form-control descM inp-fct" type="number"
                                    name="monto_descuento[]">
                            </div>

                            <div hidden>
                                <input value="0" class="form-control subtotal inp-fct" type="number" name="sub_total[]">
                            </div>

                            <div hidden>
                                <input class="form-control impP inp-fct" type="number" name="tarifa[]">
                            </div>

                            <div hidden>
                                <input value="0" class="form-control impM inp-fct" type="number"
                                    name="monto_impuesto[]">
                            </div>

                            <div class="col-1">
                                <input value="0" class="form-control totalL inp-fct" type="number" readonly disabled
                                    name="total_linea[]" required>
                            </div>

                            <div class="col-1 text-center">
                                <button class="btn btn-primary descB" type="button" data-toggle="collapse"
                                    aria-expanded="false" value="0" onclick="mostrar_descuentos(this.value)"
                                    aria-controls="descuento">
                                    <i class="fas fa-percent"></i>
                                </button>

                                <button type="button" value="0" class="btn btn-danger eliminarLinea"
                                    onclick="eliminar_linea(this)" hidden>
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
                                                        <input class=" mot form-control inp-fct" id="motivo_descuento"
                                                            value="Descuento de sistema" name="motivo_descuento[]"
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

                                                        <input class="form-control descP calcular inp-fct" max="15"
                                                            min="0" type="number" max="100" value="0">
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
                    <td colspan="1" align="right">Neto</td>
                    <td colspan="1" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_neto">
                    </td>
                    <td colspan="1" align="right">Subtotal</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_subtotal">
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="right">Descuentos</td>
                    <td colspan="1" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_descuentos">
                    </td>
                    <td colspan="1" align="right">IVA</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_iva">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="notas" placeholder="Observaciones"
                            class="form-control bg-gray text-gray"></td>
                    <td colspan="1" align="right">Total</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_total">
                    </td>
                </tr>

                <tr>
                    <td colspan="6">
                        <!-- Select con los tipos de documentos -->
                        <select class="form-control form-control-sm tipo_documento inp-fct" disabled
                            name="id_tipo_documento">
                            <!-- Recorrer tipos de documentos -->
                            <?php foreach ($tipos_documentos as $tipo_documento): ?>
                            <option value="<?php echo $tipo_documento->id_tipo_documento; ?>"
                                <?php if($tipo_documento->id_tipo_documento == $id_tipo_documento): ?> selected
                                <?php endif; ?>>
                                <?php echo $tipo_documento->tipo_documento; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

            </tfoot>
        </table>
    </div>

    <?= view('facturacion/modal/cierre_documento', $modalCierreDocumento)?>

    <?php
        if($id_tipo_documento == '02' || $id_tipo_documento == '03'){
            echo view('facturacion/modal/referencias', $data_referencias);
        }
    ?>

    <div class="contenedor-walmart">

    </div>
</form>