<div class="modal fade" id="modalAccion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title titulo-form"></h5>
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
                                if(isset($nombreForm))
                                {
                                    if(isset($dataForm))
                                        echo view($nombreForm, $dataForm);

                                    else
                                        echo view($nombreForm);
                                }//Fin de la validacion
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Footer del modal -->
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="fc-button-group">
                            <button type="submit" class="w-100 btn btn-primary btt-grd">Guardar</button>
                            <button type="button" class="w-100 btn btn-secondary btt-edt" onclick="editar()">Editar</button>
                            <button type="button" class="w-100 btn btn-danger btt-mod">Guardar cambios</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>