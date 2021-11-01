<?php

namespace Core\Auditorias;

use Core\Model;

class AuditoriaModel extends Model
{
	protected $nombreTabla = "auditoria";
	protected $pk_tabla = "id_auditoria";

	protected $camposTabla = [
		'id_fila',
		'tabla',
		'id_usuario',
		'accion',
		'created_at'
	];

	protected $autoIncrement = true;
}
?>