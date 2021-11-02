<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class UsuariosModel extends Model
{
	protected $nombreTabla = 'usuarios';
	protected $pk_tabla = 'id_usuario';

	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'cedula_usuario',
		'nombre',
		'correo',
		'id_rol',
		'telefono',
		'estado',
		'created_at',
		'updated_at'
	];

	protected $autoIncrement = true;

	protected $auditorias = true;
}//Fin de la clase
?>