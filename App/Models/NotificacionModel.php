<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de notificaciones del sistema */
class NotificacionModel extends Model
{
	protected $nombreTabla = 'notificaciones';
	protected $pk_tabla = 'id_notificacion';

	protected $camposTabla = [
		'titulo',
		'contenido',
		'enlace',
		'fecha_notificacion',
		'fecha_lectura',
		'id_usuario',
		'estado',
	];

	protected $dbGroup = 'seguridad';

	protected $autoIncrement = true;

	protected $auditorias = true;
}//Fin de la clase
?>