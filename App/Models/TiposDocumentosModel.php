<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de tipos de documentos */
class TiposDocumentosModel extends Model
{
	protected $nombreTabla = 'tipos_documentos';
	protected $pk_tabla = 'id_tipo_documento';

	protected $camposTabla = [
		'tipo_documento',
		"fecha_creacion",
		'estado',
	];

	protected $dbGroup = 'facturacion';
}//Fin de la clase
?>