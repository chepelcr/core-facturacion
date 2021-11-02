<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" href="<?=baseUrl('seguridad')?>">Usuarios</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/roles')?>">Roles</a>
                    <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar usuario</button>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <!--Card-->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="listado">
                    <thead>
                        <tr>
                            <th class="col-3">Numero de cédula</th>
                            <th class="col-5">Nombre completo</th>
                            <th class="col-3">Telefono</th>
                            <th class="col-1">Opciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach ($usuarios as $key => $usuario):?>
                        <tr>
                            <td><?=$usuario->cedula_usuario?></td>
                            <td><?=$usuario->nombre?></td>
                            <td><?=$usuario->telefono?></td>
                            <td>
                                <button class="btn btn-info" id="modificar"
                                    value="<?=$usuario->id_usuario?>">Modificar</button>
                                <!--Modificar articulo-->
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
    </div>
</div>

<!--Modal para agregar o modificar un usuario-->
<?php
    
    echo view('base/form', $dataModal);    
?>