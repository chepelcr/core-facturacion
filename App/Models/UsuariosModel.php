<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class UsuariosModel extends Model
{
	protected $nombreTabla = 'usuarios';
	protected $pk_tabla = 'id_usuario';

	protected $camposTabla = [
		'cedula_usuario',
		'nombre',
		'apellido',
		'correo',
		'nombre_usuario',
		'contrasenia',
		'id_sucursal',
		'id_rol',
		'id_empresa',
		'estado',
		'createdAt',
		'updatedAt'
	];

	protected $autoIncrement = true;

	protected $auditorias = true;
}//Fin de la clase
?>