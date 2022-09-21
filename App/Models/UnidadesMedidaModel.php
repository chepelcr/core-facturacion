<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de Unidades de medida */
class UnidadesMedidaModel extends Model
{
	protected $nombreTabla = 'unidades_medida';
	protected $pk_tabla = 'id_unidad';

	protected $camposTabla = [
		'descripcion',
		'simbolo',
	];

	protected $dbGroup = 'facturacion';

	protected $autoIncrement = true;
	protected $auditorias = true;
}//Fin de la clase
?>