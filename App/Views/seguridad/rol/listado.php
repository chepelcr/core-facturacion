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
                <table class="table table-bordered table-hover text-center" id="listado">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-7">Nombre del rol</th>
                            <th class="col-2">Estado</th>
                            <th class="col-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($roles as $rol):?>
                        <tr class="text-center">
                            <td><?=$rol->id_rol?></td>
                            <td><?=ucfirst($rol->nombre_rol)?></td>
                            <td>
                            <?php 
                                if($rol->estado == 1){
                                    echo '<span class="badge badge-success">Activo</span>';
                                }else{
                                    echo '<span class="badge badge-danger">Inactivo</span>';
                            }?></td>
                            <td><!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- Ver informacion-->
                                        <button class="dropdown-item" id="ver" value="<?=$rol->id_rol?>"
                                            type="button">Ver permisos</button>
                                        
                                        <?php
                                            if(validar_permiso('seguridad', 'roles', 'modificar'))
                                            {
                                        ?>
                                                <!-- Modificar -->
                                                <button class="dropdown-item" id="modificar" value="<?=$rol->id_rol?>"
                                                    type="button">Modificar</button>

                                            <!-- Si el estado del usuario es 1 -->
                                            <?php 
                                                if ($rol->estado == 1)
                                                    echo '<button class="dropdown-item" id="desactivar" value="'.$rol->id_rol.'" type="button">Desactivar</button>';

                                                else
                                                    echo '<button class="dropdown-item" id="activar" value="'.$rol->id_rol.'" type="button">Activar</button>';

                                            }//Fin de validacion de permisos
                                        ?>
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
    </div>
</div>


<!--Modal para agregar o modificar un rol-->
<?php 
    echo view('base/form', $dataModal);    
?>