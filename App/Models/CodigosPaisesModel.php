<?php
    namespace App\Models;

    use Core\Model;

    /**Codigos de los paises */
    class CodigosPaisesModel extends Model
    {
        protected $nombreTabla = 'codigos_paises';
        protected $pk_tabla = 'cod_pais';

        protected $camposTabla = [
            'nombre',
            'iso3',
            'codigo_telefono'
        ];

        
    }//Fin de la clase