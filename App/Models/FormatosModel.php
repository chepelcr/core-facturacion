<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class FormatosModel extends Model
{
	protected $nombreTabla = 'formatos';
	protected $pk_tabla = 'id_formato';

	protected $camposTabla = [
		'nombre_formato',
		'fecha_creacion',
        'estado',
	];

	protected $dbGroup = 'walmart';

	protected $autoIncrement = true;

	protected $auditorias = true;
}//Fin de la clase
?>