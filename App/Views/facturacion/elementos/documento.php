<form class="card-factura" id="card-factura-<?=$numero_documento?>" style="max-height: 300px;">
    <div class="row table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th class="col-1">#</th>
                    <th class="col-2">Codigo</th>
                    <th class="col-4">Descripcion</th>
                    <th class="col-3">Cantidad</th>
                    <th class="col-2">Total</th>
                    <th class="col-1">Opciones</th>
                </tr>
            </thead>

            <tbody class="tblDetalles scroll_vertical">
                <tr class="linea">
                    <td class="col-1 text-center">
                        <span class="numero_linea_lbl">1</span>
                        <input type="hidden" class="form-control form-control-sm numero_linea" value="1" name="linea[numero_linea][]">
                    </td>

                    <td colspan="6">
                        <div class="row">
                            <!-- Codigo de barrras -->
                            <div class="col-2">
                                <div class="input-group input-group-sm">
                                    <!-- Codigo de barras -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>

                                    <input class="form-control form-control-sm inp-fct codigo_venta" type="number" min="0"  readonly
                                        placeholder="Código de barras" disabled>
                                    <input type="hidden" name="linea[codigo_venta][]" class="codigo_venta">
                                    <input class="codigo" type="hidden" name="linea[codigo][]">
                                </div>
                            </div>

                            <!-- Descripcion -->
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <!-- Descripcion -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                    </div>

                                    <input class="form-control form-control-sm inp-fct descripcion" type="text"
                                        placeholder="Descripción" readonly disabled>
                                    <input type="hidden" name="linea[detalle][]" class="descripcion">
                                        
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="input-group input-group-sm">
                                    <input value="0" class="form-control form-control-sm cantidad calcular inp-fct" min="1" type="number"
                                        name="linea[cantidad][]" required>
                                    </div>
                            </div>

                            <!-- Unidad -->
                            <div class="col-2">
                                <div class="input-group input-group-sm">
                                    <!-- Unidad -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                    </div>
                                    
                                    <select class="form-control form-control-sm unidad inp-fct" disabled>
                                        <option value="">Seleccionar</option>
                                        <!-- Recorrer unidades de medida -->
                                        <?php foreach ($unidades_medida as $unidad): ?>
                                        <option value="<?= $unidad->simbolo ?>"
                                            <?php if($unidad->id_unidad == 85 ) echo 'selected'?>>
                                            <?= $unidad->descripcion ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <input type="hidden" name="linea[unidad][]" class="unidad">
                                </div>
                            </div>

                            <div class="col-2">
                                <input value="0" class="form-control form-control-sm totalVL inp-fct" readonly disabled>
                            </div>

                            <div class="col-1 text-center">
                                <div class="row d-flex justify-content-around">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary descB btn-sm" type="button"
                                            onclick="mostrar_detalles(this)">
                                            <i class="fas fa-percent"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-6 eliminarLinea">
                                        <button type="button" class="btn btn-danger btn-sm eliminarLinea"
                                            onclick="eliminar_linea(this)" hidden>
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?= view('facturacion/modal/detalle', $modalLinea) ?>
                    </td>
                </tr>
            </tbody>

            <tfoot class="table-sm sinBorde">
                <tr>
                    <td colspan="2" align="right">Neto</td>
                    <td colspan="1" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_neto">
                    </td>
                    <td colspan="1" align="right">Subtotal</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_subtotal">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">Descuentos</td>
                    <td colspan="1" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_descuentos">
                    </td>
                    <td colspan="1" align="right">I.V.A</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_iva">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input type="text" name="notas" placeholder="Observaciones"
                            class="form-control bg-gray text-gray"></td>
                    <td colspan="1" align="right">Total</td>
                    <td colspan="2" align="right">
                        <input type="text" disabled readonly class="form-control form-control-sm lbl_total">
                    </td>
                </tr>

                <tr hidden>
                    <td>
                        <input type="hidden" class="tipo_documento inp-fct" name="id_tipo_documento" value="<?=$id_tipo_documento?>">
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