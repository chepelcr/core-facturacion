<?php

namespace App\Models;

use Core\Model;

/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class RolesModel extends Model
{
	protected $nombreTabla = "roles";
	protected $pk_tabla = "id_rol";

	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'nombre_rol',
		'estado',
		'created_at',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;
}
?>