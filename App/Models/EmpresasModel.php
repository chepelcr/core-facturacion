<?php
namespace App\Models;

use Core\Model;

/**Manejador de la tabla Empresas */
class EmpresasModel extends Model
{
    protected $nombreTabla = 'empresas';
    protected $pk_tabla = 'id_empresa';
    protected $vistaTabla = 'empresas_view';

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
        'activo'
    ];

    protected $camposVista = [
        'tipo_identificacion',
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

    protected $auditorias = true;
    protected $autoIncrement = true;
}//Fin de la clase