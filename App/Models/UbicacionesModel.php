<?php
    namespace App\Models;

use Core\Model;

/**Modelo para tabla de ubicaciones */
class UbicacionesModel extends Model
{
    protected $nombreTabla = 'ubicaciones';
    protected $pk_tabla = 'id_ubicacion';

    protected $camposTabla = [
        'cod_provincia',
        'provincia',
        'cod_canton',
        'canton',
        'cod_distrito',
        'distrito',
        'cod_barrio',
        'barrio',
    ];

    protected $dbGroup = 'seguridad';

    protected $autoIncrement = true;
    protected $auditorias = true;

    /**Obtener todas las provincias */
    public function provincias()
    {
        $this->table('provincias_view');
        $this->select('cod_provincia')->select('provincia');

        return $this->getAll();
    }//Fin de la funcion

    /**Obtener todos los cantones para una provincia */
    public function cantones($cod_provincia = null)
    {
        $this->table('cantones_view')->select('cod_canton')->select('canton');

        if($cod_provincia)
        {
            $this->where('cod_provincia', $cod_provincia);
        }//Fin de los cantones

        return $this->getAll();
    }//Fin de la funcion

    /**Obtener todos los distritos para el canton de una provincia */
    public function distritos($cod_provincia = null, $cod_canton = null)
    {
        $this->table('distritos_view')->select('cod_canton')->select('cod_distrito')->select('distrito');

        if($cod_provincia)
        {
            $this->where('cod_provincia', $cod_provincia);
        }//Fin de filtro por provincia

        if($cod_canton)
        {
            $this->where('cod_canton', $cod_canton);
        }//Fin de los cantones

        return $this->getAll();
    }//Fin de la funcion

    /**Obtener todos los barrios para el distrito de un canton en una provincia */
    public function barrios($cod_provincia = null, $cod_canton = null, $cod_distrito = null)
    {
        $this->select('cod_canton')->select('cod_distrito')->select('cod_barrio')->select('barrio');

        if($cod_provincia)
        {
            $this->where('cod_provincia', $cod_provincia);
        }//Fin de filtro por provincia

        if($cod_canton)
        {
            $this->where('cod_canton', $cod_canton);
        }//Fin de los cantones

        if($cod_distrito)
        {
            $this->where('cod_distrito', $cod_distrito);
        }//Fin de los distritos

        return $this->getAll();
    }//Fin de la funcion
}//Fin de la clase