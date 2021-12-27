<div class="card">
    <div class="card-body scroll_vertical">
        <table class="table table-bordered table-hover text-center" id="listado">
            <thead>
                <tr>
                    <th class="col-2">Identificación</th>
                    <th class="col-6">Nombre completo</th>
                    <th class="col-3">Correo electrónico</th>
                    <th class="col-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $key => $cliente):?>
                <tr>
                    <td><?=$cliente->identificacion?></td>
                    <td><?=$cliente->razon?></td>
                    <td><?=$cliente->correo?></td>
                    <td>
                        <div class="btn-group">
                            <!-- Ver informacion-->
                            <button data-toggle="tooltip" title="Ver cliente"
                                onclick="ver_cliente('<?=$cliente->id_cliente?>')" class="btn btn-secondary"
                                type="button">
                                <i class="fas fa-eye"></i>
                            </button>

                            <?php
                                            if(validar_permiso('empresa', 'clientes', 'modificar'))
                                            {
                                        ?>
                            <!--Modificar cliente-->
                            <button data-toggle="tooltip" title="Modificar cliente"
                                onclick="modificar_cliente('<?=$cliente->id_cliente?>')" class="btn btn-secondary"
                                type="button">
                                <i class="fas fa-edit"></i>
                            </button>
                            <?php
                                            }
                                        ?>
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


<!--Modal para agregar o modificar un cliente-->
<?php echo view('base/form', $dataModal);?>
<!--Fin del modal-->