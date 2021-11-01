<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <button type="button" class="btn btn-danger col-md-3" id="btnAgregar">Agregar Articulo</button>
        </nav>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Unidad de medida</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $key => $articulo):?>
                <tr>
                    <td><?=$articulo->codigo?></td>
                    <td><?=$articulo->descripcion?></td>
                    <td><?=$articulo->descripcion_unidad?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <!--Modificar articulo-->

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!--Modificar articulo-->
                                <button id="modificar" value="<?=$articulo->id_producto?>" class="dropdown-item"
                                    type="button">Modificar</button>

                                <!--Ver inventario-->
                                <button id="inventario" value="<?=$articulo->id_producto?>" class="dropdown-item"
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


<!--Modal para agregar o modificar un articulo-->
<?php
    echo view('base/form', $dataModal);


    echo view('empresa/producto/cabys');
?>