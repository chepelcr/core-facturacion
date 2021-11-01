<div class="modal fade" id="modal_inventario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title">Inventario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="container">
                    <div class="container-fluid">
                        <table id="tbl_inventario">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Precio de venta</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>

                            <tbody id="inventario_body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer del modal -->
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="fc-button-group">
                        <button type="button" class="w-100 btn btn-dark btt-crr">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>