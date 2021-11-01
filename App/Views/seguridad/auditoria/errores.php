<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">Errores</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/auditorias')?>">Auditorias</a>
        </nav>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th>Fecha del error</th>
                    <th>Controlador</th>
                    <th>Sentencia</th>
					<th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($errores as $error):?>
                <tr>
                    <td><?=$error->createdAt?></td>
                    <td><?=$error->controlador?></td>
                    <td><?=$error->sentencia?></td>
                    <td>
                        <button class="btn btn-info" id="modificar" value="<?=$error->id_error?>">Ver mas</button>
                        <!--Ver mas informacion-->
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