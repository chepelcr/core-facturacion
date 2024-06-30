<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class DocumentoReferenciasModel extends Model
{
	protected $nombreTabla = 'documentos_referencias';
	protected $pk_tabla = 'id_referencia';

	protected $camposTabla = [
		'id_documento',
        'referencia_tipo_documento',
        'referencia_clave',
        'referencia_fecha',
        'referencia_codigo',
        'referencia_razon',
        'fecha_creacion',
	];

    protected $autoIncrement = true;

    protected $dbGroup = 'facturacion';

    protected $auditorias = true;

    public function getDocumentoReferencias($id_documento)
    {
        $this->where('id_documento', $id_documento);
        return $this->getAll();
    }
}//Fin de la clase
?>