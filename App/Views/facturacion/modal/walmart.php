<div class="modal fade modal-walmart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title titulo-form">
                    <!-- Icono con imagen personalizada -->
                    <img src="<?=getFile('dist/img/walmart.png') ?>" alt="Walmart" class="img-fluid icn">
                    Informacion de entrega
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="row contenedor-datos">
                    <!-- Select con Numero de proveedor -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="numero_proveedor">Numero de proveedor</label>
                            <div class="input-group">
                                <!-- Recorrer los numeros de proveedor -->
                                <select class="form-control inp-fct form-control-sm numero_vendor" id="numero_vendor" name="numero_vendor">
                                    <option value="">Seleccione un numero de proveedor</option>
                                    <?php foreach ($numerosProveedor as $numero_proveedor): ?>
                                        <option value="<?=$numero_proveedor->id_proveedor ?>"><?=$numero_proveedor->id_proveedor ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Punto de entrega -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="numero_punto_entrega">Punto de entrega</label>
                            <div class="input-group">
                                <input type="text" class="form-control nombre_gnl" placeholder="Buscar tienda" id="nombre_gnl"
                                    readonly disabled>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="buscar_tiendas()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- enviar_gnl -->
                    <div class="col-md-12" hidden>
                        <input type="text" class="form-control inp-fct enviar_gnl" id="enviar_gnl" name="enviar_gnl">
                    </div>

                    <!-- Numero de orden -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="numero_orden_compra">Numero de orden</label>
                            <div class="input-group">
                                <input type="text" class="form-control inp-fct numero_orden" max="8" min="8" placeholder="Ingrese el numero de orden" id="numero_orden" name="numero_orden">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row contenedor-tiendas">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" onkeyup="filtrar_tabla('tiendas', this.value)" onchange="filtrar_tabla('tiendas', this.value)" class="form-control inp-fct" id="q_tienda">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" disabled>
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-body">
                            <?= view('facturacion/table/tiendas', $dataTiendas)?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer del modal -->
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="fc-button-group">
                        <div class="d-flex justify-content-around">
                            <!-- Aceptar -->
                            <button type="button" class="btn btn-success col-8 btn-aceptar" data-dismiss="modal">
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>