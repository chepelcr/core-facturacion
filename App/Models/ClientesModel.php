<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class ClientesModel extends Model
{
	protected $nombreTabla = 'clientes';
    protected $vistaTabla = 'clientes_view';

	protected $pk_tabla = 'id_cliente';

	protected $camposTabla = [
        'identificacion',
        'id_tipo_identificacion',
        'razon',
        'nombre_comercial',
        'id_ubicacion',
        'otras_senas',
        'telefono',
        'cod_pais',
        'correo',
        'estado'
    ];

    protected $camposVista = [
        'tipo_identificacion',
        'nombre',
        'cod_provincia',
        'provincia',
        'cod_canton',
        'canton',
        'cod_distrito',
        'distrito',
        'cod_barrio',
        'barrio',
        'codigo_telefono'
    ];

    protected $dbGroup = 'facturacion';

	protected $autoIncrement = true;

	protected $auditorias = true;

    /**Obtener un cliente por numero de identificacion */
    public function getByIdentificacion($identificacion)
    {
        $this->where('identificacion', $identificacion);

        return $this->fila();
    }
}//Fin de la clase
?>