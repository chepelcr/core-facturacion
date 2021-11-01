<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">Activos</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">Inactivos</a>
            <button class="btn btn-danger col-md-3" id="btnAgregar">Agregar sucursal</button>
        </nav>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th>Nombre de la sucursal</th>
                    <th>Direccion exacta</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($sucursales as $sucursal):?>
                <tr>
                    <td><?=$sucursal->nombre_sucursal?></td>
                    <td><?=$sucursal->otras_senias?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <!--Modificar articulo-->

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!--Modificar articulo-->
                                <button id="modificar" value="<?=$sucursal->id_sucursal?>" class="dropdown-item"
                                    type="button">Modificar</button>

                                <!--Ver inventario-->
                                <button id="inventario" value="<?=$sucursal->id_sucursal?>" class="dropdown-item"
                                    type="button">Ver inventario</button>
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

<!--Modal para agregar o modificar un rol-->
<?php 
    echo view('base/form', $dataModal);
    
    echo view('empresa/sucursal/inventario');
    
?>