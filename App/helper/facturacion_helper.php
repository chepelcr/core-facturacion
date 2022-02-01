<?php

use App\Models\UbicacionesModel;

/**Obtener un nuevo documento */
function documento($tipo_documento = '01', $numero_documento)
{
    $nombreVista = 'facturacion/elementos/documento';

    $tiposDocumentosModel = model('tiposDocumentos');
    $uniMedidaModel = model('unidadesMedida');
    $tiposReferenciaModel = model('tiposReferencia');

    $modalCierreDocumento = array(
        'numero_documento' => $numero_documento,
        'tipo_documento' => $tipo_documento,
    );

    if($tipo_documento == '02' || $tipo_documento == '03')
    {
        $data_referencias = array(
            'tipos_documentos' => $tiposDocumentosModel->obtener('all'),
            'codigos_referencia' => $tiposReferenciaModel->obtener('all'),
        );
    }

    $dataView = array(
        'id_tipo_documento' => $tipo_documento,
        'tipos_documentos' => $tiposDocumentosModel->getAll(),
        'unidades_medida' => $uniMedidaModel->getAll(),
        'numero_documento' => $numero_documento,
        'modalCierreDocumento' => $modalCierreDocumento,
        'data_referencias' => $data_referencias ?? null,
    );

    return view($nombreVista, $dataView);
}

/**Obtener la informacion de facturacion para los clientes */
function getInfoClientes()
{
    $ubicacionesModel = new UbicacionesModel();

    $tipoIdentificacionModel = model('tipoIdentificacion');
    $codigosPaisesModel = model('codigosPaises');

    $modalCliente = array(
        'buscar_cliente' => array(
            'dataForm' => array(
                'datos_personales' => array(
                    'identificaciones' => $tipoIdentificacionModel->getAll(),
                    'codigos' => $codigosPaisesModel->getAll(),
                ),

                'dataProvincias' => array(
                    'provincias' => $ubicacionesModel->provincias(),
                ),
            )
        ),
    );
    return $modalCliente;
}

/**Obtener la informacion para los documentos de walmart */
function getInfoWalmart()
{
    $tiendasModel = model('tiendas');
    $numerosProveedorModel = model('numerosProveedor');

    $dataTiendas = array(
        'tiendas' => $tiendasModel->getAll(),
    );

    $data = array(
        'numerosProveedor' => $numerosProveedorModel->getAll(),
        'dataTiendas' => $dataTiendas,
    );

    return $data;
}
