<div class="modal fade modal-cierre" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title titulo-form">Finalizar documento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-pago">
                            <div class="form-group">
                                <div class="card-header">
                                    <div class="h4">
                                        <label for="medios_pago" class="card-title">Medio de pago</label>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Seleccionar medios de pago (Efectivo, transferencia, tarjeta) por medio de checkbox -->
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="d-flex justify-content-around text-center">
                                                <div class="card w-25">
                                                    <div class="card-header">
                                                        <div class="h4 text-center">
                                                            <label for="efectivo" class="card-title"><i
                                                                    class="fas fa-money-bill-alt fa-3x"></i></label>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="efectivo">
                                                            <label class="form-check-label" for="efectivo">
                                                                Efectivo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card w-25">
                                                    <div class="card-header">
                                                        <div class="h4 text-center">
                                                            <label for="transferencia" class="card-title text-center"><i
                                                                    class="fas fa-exchange-alt fa-3x"></i></label>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="transferencia">
                                                            <label class="form-check-label" for="transferencia">
                                                                SINPE
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card w-25">
                                                    <div class="card-header">
                                                        <div class="h4 text-center">
                                                            <label for="tarjeta" class="card-title"><i
                                                                    class="fas fa-credit-card fa-3x"></i></label>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="tarjeta">
                                                            <label class="form-check-label" for="tarjeta">
                                                                Tarjeta
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="total_pago" class="card-title">Total a pagar</label>
                                                <input type="text" class="form-control lbl_total" disabled readonly
                                                    placeholder="Total a pagar">
                                            </div>
                                            <div class="form-group">
                                                <label for="total_pago" class="card-title">Total pagado</label>
                                                <input type="text" class="form-control" id="total_pago"
                                                    placeholder="Total pagado">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="card card-body card-otros">
                                                <div class="row">
                                                    <!-- Si el tipo de documento no es 04, mostrar los clientes disponibles -->
                                                    <?php if ($tipo_documento != '04') { ?>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="cliente">Cliente</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="far fa-user"></i></span>
                                                                </div>
                                                                <input type="text" disabled readonly
                                                                    class="form-control nombre-cliente">

                                                                <div class="input-group-append">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary" onclick="ver_modal_cliente(); 
                                                                            //Cerrar modal-cierre
                                                                            $('.modal-cierre').modal('hide');">
                                                                        <i class="fas fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <div class="col-md-12">
                                                        <!-- Tipo de cambio-->
                                                        <div class="form-group">
                                                            <label for="tipo_cambio">Tipo de cambio</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fas fa-money-bill"></i></span>
                                                                        </div>
                                                                        <select class="form-control moneda" onchange="obtener_tipo_cambio(this.value)"
                                                                            name="moneda" required>
                                                                            <option value="CRC">Colones</option>
                                                                            <option value="USD">Dolares</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Valor de la moneda -->
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fas fa-hand-holding-usd"></i></span>
                                                                        </div>
                                                                        <input class="form-control tipo_cambio"
                                                                            name="tipo_cambio" readonly required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tipo de venta -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tipo_venta">Tipo de venta</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-handshake"></i></span>
                                                                </div>
                                                                <select class="form-control" id="condicion_venta"
                                                                    name="condicion_venta" required>
                                                                    <option value="01" selected>Contado</option>
                                                                    <option value="02">Credito 30 dias</option>
                                                                </select>
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
                </div>
            </div>

            <!-- Footer del modal -->
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="fc-button-group">
                        <div class="d-flex justify-content-around">
                            <!-- Guardar documento-->
                            <button type="submit" class="btn btn-success col-2 btn-guardar-documento"
                                data-toggle="tooltip" title="Guardar">
                                <i class="fas fa-save"></i>
                            </button>

                            <!-- Colones -->
                            <button type="button" class="btn btn-outline-secondary col-2" onclick="cambiar_colones();"
                                data-toggle="tooltip" title="Colones">
                                <i class="fas fa-money-bill-wave"></i>
                            </button>

                            <!-- Dolar -->
                            <button type="button" class="btn btn-outline-secondary col-2" onclick="cambiar_dolar();"
                                hidden data-toggle="tooltip" title="Dolares">
                                <i class="fas fa-money-bill-wave"></i>
                            </button>

                            <!-- Contado -->
                            <button type="button" class="btn btn-outline-secondary col-2" onclick="cambiar_contado();"
                                data-toggle="tooltip" title="Venta de contado">
                                <i class="fas fa-money-bill-wave"></i>
                            </button>

                            <!-- Credito -->
                            <button type="button" class="btn btn-outline-secondary col-2" onclick="cambiar_credito();"
                                hidden data-toggle="tooltip" title="Venta a credito">
                                <i class="fas fa-money-bill-wave"></i>
                            </button>

                            <!-- Cancelar -->
                            <button type="button" class="btn btn-danger col-2" onclick="cancelar_documento();"
                                data-toggle="tooltip" title="Cancelar">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>