<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">Activos</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/auditorias')?>">Inactivos</a>
            <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar producto</button>
        </nav>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th class="col-1">Id</th>
                    <th class="col-9">Nombre</th>
                    <th class="col-2">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Almohada y funda bebé colores surtidos</td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <!--Modificar articulo-->

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" type="button">Modificar</button>
                                <button class="dropdown-item" hidden id="btn_desactivar" value="1"
                                    type="button">Desactivar</button>
                                <button class="dropdown-item" id="btn_activar" value="1"
                                    type="button">Activar</button>
                            </div>
                        </div>

                    </td>
                    <!--Fin de las opciones-->
                </tr>
                <!--Fin de la fila-->
            </tbody>
            <!--/Cuerpo de la tabla-->
        </table>
        <!--/Table-->
    </div>
    <!--/Card body-->
</div>
<!--/Card-->


<!--Modal para agregar o modificar un usuario-->
<?php echo view('base/form', $dataModal);?>