<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad')?>">Usuarios</a>
                    <a class="flex-sm-fill text-sm-center nav-link active" href="<?=baseUrl('seguridad/roles')?>">Roles</a>
                    <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar rol</button>
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
                            <th class="col-7">Nombre del rol</th>
                            <th class="col-3">Fecha de creacion</th>
                            <th class="col-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($roles as $rol):?>
                        <tr>
                            <td><?=$rol->nombre_rol?></td>
                            <td><?=$rol->created_at?></td>
                            <td>
                                <button class="btn btn-info" id="modificar" value="<?=$rol->id_rol?>">Modificar</button>
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


<!--Modal para agregar o modificar un rol-->
<?php 
    echo view('base/form', $dataModal);    
?>