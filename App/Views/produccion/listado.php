<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">En proceso</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('prodccion/finalizados')?>">Finalizados</a>
            <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar lote</button>
        </nav>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th class="col-1">Id</th>
                    <th class="col-4">Fecha de creacion</th>
                    <th class="col-4">Valor</th>
                    <th class="col-2">Estado</th>
                    <th class="col-1">Acciones</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?= date('c');?></td>
                    <td>$1.000.000</td>
                    <td>PROCESO</td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <!--Modificar articulo-->

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" type="button">Ver detalle</button>
                                <button class="dropdown-item" id="btn_desactivar" value="1"
                                    type="button">Finalizar</button>
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