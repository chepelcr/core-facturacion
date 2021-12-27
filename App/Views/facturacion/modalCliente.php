<div class="modal fade modal-clientes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">
            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title titulo-form">Clientes</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Inicio del formulario -->
            <form id="frm">
                <!-- Contenido del modal -->
                <div class="modal-body">
                    <div class="container">
                        <div class="container-fluid">
                            <?php
                                echo view('facturacion/cliente', $buscar_cliente);
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Footer del modal -->
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="fc-button-group">
                            <div class="d-flex justify-content-around">
                                <!-- Seleccionar otro cliente -->
                                <button type="button" onclick="buscar_clientes()" class="w-25 btn btn-secondary btt-sct-clt">
                                    Seleccionar cliente
                                </button>

                                <!-- Editar -->
                                <button type="button" onclick="editar_cliente()" class="w-25 btn btn-danger btt-edt-clt">Editar</button>

                                <!-- Guardar cliente-->
                                <button type="button" onclick="enviar_frm('frm_clientes_<?=$numero_documento?>')"
                                class="w-50 btn btn-primary btt-grd-clt">Guardar</button>

                                <!-- Aceptar -->
                                <button type="button" class="w-25 btn btn-success btt-aceptar-clt"
                                    data-dismiss="modal">Aceptar</button>

                                <!-- Guardar cambios -->
                                <button type="button" class="w-50 btn btn-secondary btt-grd-clt-cambios">Guardar
                                cambios</button>

                                
                                <!-- Agregar -->
                                <button type="button" onclick="agregar_cliente()"
                                    class="w-100 btn btn-warning btt-add-clt">Agregar cliente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>