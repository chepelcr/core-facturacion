<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar cliente</button>
        </nav>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th>Cedula del cliente</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $key => $cliente):?>
                <tr>
                    <td><?=$cliente->identificacion?></td>
                    <td><?=$cliente->razon?></td>
                    <td><?=$cliente->correo?></td>
                    <td>
                    <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <!--Modificar articulo-->

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!--Modificar cliente-->
                                <button id="modificar" value="<?=$cliente->id_cliente?>" class="dropdown-item" type="button">Modificar</button>

                                <!--Ver documentos emitidos-->
                                <button id="documentos" value="<?=$cliente->id_cliente?>" class="dropdown-item" type="button">Ver facturas</button>
                            </div>
                        </div>
                    </td>
                    <!--Fin de las opciones-->
                </tr>
                <!--Fin de la fila-->
                <?php endforeach;?>
                <!--Fin del ciclo-->
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