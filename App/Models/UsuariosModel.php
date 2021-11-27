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
		'nombre',
		'apellidos',
		'nombre_usuario',
		'cedula_usuario',
		'tipo_cedula',
		'correo',
		'id_rol',
		'id_empresa',
		'telefono',
		'fecha_registro',
		'fecha_actualizacion',
		'fecha_eliminacion',
		'estado'
	];

	protected $autoIncrement = true;

	protected $auditorias = true;
}//Fin de la clase
?>