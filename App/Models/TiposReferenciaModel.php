<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de tipos de referencias */
class TiposReferenciaModel extends Model
{
	protected $nombreTabla = 'tipos_referencia';
	protected $pk_tabla = 'id_codigo';

	protected $camposTabla = [
		'tipo_referencia',
		"fecha_creacion",
		'estado',
	];

	protected $dbGroup = 'facturacion';


	protected $auditorias = true;
}//Fin de la clase
?>