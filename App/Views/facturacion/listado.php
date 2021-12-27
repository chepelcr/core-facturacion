<table class="table table-bordered table-hover text-center" id="listado">
    <thead class=" bg-info">
        <tr>
            <th>Fecha</th>
            <th>Consecutivo</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($documentos as $key => $documento):?>
        <tr>
            <td><?=$documento->fecha?></td>
            <td><?=$documento->consecutivo?></td>
            <td><?=$documento->receptor_nombre?></td>
            <td>¢ <?=number_format($documento->total_comprobante,"2",",",".") ?></td>
            <td>
                <!-- Imprimir -->
                <button onclick="location.href='<?=baseUrl('documentos/descargar_pdf/'.$documento->clave)?>';"
                    type="button" data-toggle="tooltip" data-placement="top" title="Descargar"
                    class="btn btn-sm btn-outline-info btn-descargar">
                    <i class="fas fa-download"></i>
                </button>

                <!-- Ver PDF en nueva pestania-->
                <button onclick="verPdf('<?=$documento->clave?>');" type="button"
                    data-toggle="tooltip" data-placement="top" title="Ver documento"
                    class="btn btn-sm btn-outline-info btn-ver">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>