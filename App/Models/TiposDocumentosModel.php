<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de tipos de documentos */
class TiposDocumentosModel extends Model
{
	protected $nombreTabla = 'tipos_documentos';
	protected $pk_tabla = 'id_tipo';

	protected $camposTabla = [
		'id_tipo_documento',
		'descripcion',
		'tipo_documento',
		'estado',
		"fecha_creacion",
		"fecha_modificacion",
		"fecha_eliminacion",
	];

	protected $dbGroup = 'facturacion';

	protected $auditorias = true;

	/**Obtener los tipos de documentos de referencia o facturacion */
	public function obtener($id = 'all')
	{
		switch ($id) {
			case 'documentos':
				$this->where('tipo_documento', 'E');
				break;

			case 'referencias':
				$this->where('tipo_documento', 'R');
				break;

			default:
				return $this->getById($id);
				break;
		}//Fin del switch

		$this->where('estado', 1);
		return $this->getAll();
	}//Fin de la funcion obtener
}//Fin de la clase
?>