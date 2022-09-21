<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de tipo de cambio del dolar */
class TipoCambioModel extends Model
{
	protected $nombreTabla = 'tipo_cambio_historico';
	protected $pk_tabla = 'id_tipo_cambio';

	protected $camposTabla = [
		'tipo_cambio',
		'fecha_cambio',
		'codigo_indicador',
		'cod_pais',
	];

	protected $dbGroup = 'facturacion';

	protected $autoIncrement = true;

	protected $auditorias = true;

	/**Obtener el tipo de cambio mas reciente por el codigo de indicador */
	function obtener($id)
	{
		switch ($id) {
			case 'all':
				return $this->getAll();
				break;

			default:
				return $this->where('codigo_indicador', $id)->fila();
				break;
		}
	}
}//Fin de la clase
?>