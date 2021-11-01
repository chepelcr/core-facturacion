<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/errores')?>">Errores</a>
            <a class="flex-sm-fill text-sm-center nav-link active" href="#">Auditorias</a>
        </nav>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover" id="listado">
            <thead>
                <tr>
                    <th>Fecha de la auditoria</th>
                    <th>Controlador</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auditorias as $auditoria):?>
                <tr>
                    <td><?=$auditoria->created_at?></td>
                    <td><?=$auditoria->tabla?></td>
                    <td><?=$auditoria->id_usuario?></td>
                    <td>
                        <button class="btn btn-info" id="modificar" value="<?=$auditoria->id_auditoria?>">Ver
                            mas</button>
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