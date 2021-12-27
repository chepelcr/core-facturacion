<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class DocumentoDetallesModel extends Model
{
	protected $nombreTabla = 'documentos_detalles';
	protected $pk_tabla = 'id_detalle';

	protected $camposTabla = [
		'id_documento',
        'linea',
        'codigo',
        'cantidad',
        'unidad_medida',
        'detalle',
        'precio_unidad',
        'monto_total',
        'monto_descuento',
        'motivo_descuento',
        'sub_total',
        'codigo_impuesto',
        'codigo_tarifa',
        'tarifa',
        'monto_impuesto',
        'tipo_exoneracion',
        'numero_exoneracion',
        'institucion_exoneracion',
        'fecha_exoneracion',
        'porcentaje_exoneracion',
        'monto_exoneracion',
        'impuesto_neto',
        'total_linea'
	];    

    protected $autoIncrement = true;

    protected $dbGroup = 'facturacion';

    protected $auditorias = true;

    public function getDocumentoDetalles($id_documento)
    {
        $this->where('id_documento', $id_documento);
        return $this->getAll();
    }
}//Fin de la clase
?>