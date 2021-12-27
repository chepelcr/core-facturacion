<?php
namespace App\Models;

use Core\Model;

/**Manejador de la tabla Empresas */
class EmpresasModel extends Model
{
    protected $nombreTabla = 'empresas';
    protected $vistaTabla = 'empresas_view';

    protected $pk_tabla = 'id_empresa';

    protected $camposTabla = [
        'identificacion',
        'id_tipo_identificacion',
        'razon',
        'nombre_comercial',
        'cod_actividad',
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
        'codigo_telefono',
        'nombre_pais',
        'cod_provincia',
        'cod_canton',
        'cod_distrito',
        'cod_barrio',
        'provincia',
        'canton',
        'distrito',
        'barrio',
    ];

    protected $dbGroup = 'seguridad';

    protected $auditorias = true;
    protected $autoIncrement = true;
}//Fin de la clase