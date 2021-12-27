<?php

namespace App\Models;

use Core\Model;

class DocumentoModel extends Model
{
    protected $nombreTabla = 'documentos';

    protected $pk_tabla = 'id_documento';

    protected $camposTabla = [
        'consecutivo',
        'tipo_documento',
        'clave',
        'codigo_seguridad',
        'fecha',
        'emisor_cedula',
        'emisor_nombre',
        'emisor_tipo',
        'emisor_comercial',
        'emisor_id_provincia',
        'emisor_id_canton',
        'emisor_id_distrito',
        'emisor_id_barrio',
        'emisor_otras_senas',
        'emisor_cod',
        'emisor_telefono',
        'emisor_correo',
        'receptor_nombre',
        'receptor_cedula',
        'receptor_tipo',
        'receptor_comercial',
        'receptor_id_provincia',
        'receptor_id_canton',
        'receptor_id_distrito',
        'receptor_id_barrio',
        'receptor_otras_senas',
        'receptor_cod',
        'receptor_telefono',
        'receptor_correo',
        'condicion_venta',
        'plazo_credito',
        'medio_pago',
        'moneda',
        'tipo_cambio',
        'servicios_gravados',
        'servicios_exentos',
        'servicios_exonerados',
        'mercancias_gravadas',
        'mercancias_exentas',
        'mercancias_exoneradas',
        'total_gravado',
        'total_exento',
        'total_exonerado',
        'total_venta',
        'total_descuentos',
        'total_venta_neta',
        'total_impuestos',
        'total_comprobante',
        'notas',
        'envio_atv',
        'valido_atv',
        'fecha_envio',
        'fecha_valido',
        'id_usuario',
        'id_empresa',
    ];

    protected $autoIncrement = true;

    protected $dbGroup = 'facturacion';

    protected $auditorias = true;

    public function getDocumento($clave)
    {
        $this->where('clave', $clave);
        return $this->fila();
    }
}
