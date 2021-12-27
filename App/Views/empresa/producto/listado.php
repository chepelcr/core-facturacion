<!--Card-->
<div class="card">
    <div class="card-body scroll_vertical">
        <table class="table table-bordered table-hover text-center" id="listado">
            <thead>
                <tr>
                    <th class="col-2">Código</th>
                    <th class="col-5">Nombre</th>
                    <th class="col-2">Impuesto</th>
                    <th class="col-2">Precio final</th>
                    <th class="col-1">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $key => $articulo):?>
                <tr>
                    <td><?=$articulo->codigo_venta?></td>
                    <td><?=$articulo->descripcion?></td>
                    <td><?=$articulo->impuesto?>%</td>
                    <td><?=$articulo->valor_total?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Ver informacion-->
                                <button id="ver" value="<?=$articulo->id_producto?>" class="dropdown-item"
                                    type="button">Ver información</button>

                                <!--Modificar articulo-->
                                <button id="modificar" value="<?=$articulo->id_producto?>" class="dropdown-item"
                                    type="button">Modificar</button>
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