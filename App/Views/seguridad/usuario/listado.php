<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                        echo view('seguridad/nav', array('submodulo'=>'usuarios','objeto'=>'usuario'));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <!--Card-->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="listado">
                    <thead>
                        <tr class="text-center">
                            <th class="col-3">Numero de cédula</th>
                            <th class="col-5">Nombre completo</th>
                            <th class="col-3">Estado</th>
                            <th class="col-1">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($usuarios as $key => $usuario):?>
                        <tr class="text-center">
                            <td><?=$usuario->cedula_usuario?></td>
                            <td><?=$usuario->nombre?></td>
                            <td>
                                <?php 
                                if($usuario->estado == 1){
                                    echo '<span class="badge badge-success">Activo</span>';
                                }else{
                                    echo '<span class="badge badge-danger">Inactivo</span>';
                            }?></td>
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- Ver informacion-->
                                        <button class="dropdown-item" id="ver" value="<?=$usuario->id_usuario?>"
                                            type="button">Ver información</button>

                                        <?php
                                            if(validar_permiso('seguridad', 'usuarios', 'modificar'))
                                            {
                                        ?>
                                        <!-- Modificar -->
                                        <button class="dropdown-item" id="modificar" value="<?=$usuario->id_usuario?>"
                                            type="button">Modificar</button>

                                        <!-- Enviar contrasenia -->
                                        <button class="dropdown-item" id="enviar" value="<?=$usuario->id_usuario?>"
                                            type="button">Enviar contraseña</button>

                                        <!-- Si el estado del usuario es 1 -->
                                        <?php 
                                                if ($usuario->estado == 1)
                                                    echo '<button class="dropdown-item" id="desactivar" value="'.$usuario->id_usuario.'" type="button">Desactivar</button>';

                                                else
                                                    echo '<button class="dropdown-item" id="activar" value="'.$usuario->id_usuario.'" type="button">Activar</button>';

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

<!--Modal para agregar o modificar un usuario-->
<?php
    
    echo view('base/form', $dataModal);    
?>