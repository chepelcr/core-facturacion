<?php
namespace App\Controllers;

use App\Models\UbicacionesModel;

class Ubicacion extends BaseController
{
    /**Obtener los cantones o para una provincia */
    public function cantones()
    {
        $ubicacionesModel = new UbicacionesModel();

        if(isset($_POST['cod_provincia'])&&$_POST['cod_provincia']!="")
        {
            return json_encode($ubicacionesModel->cantones($_POST['cod_provincia']));
        }//Fin de validacion

        return json_encode(false);
    }//Fin de la funcion

    /**Obtener todos los distritos para un canton */
    public function distritos()
    {
        $ubicacionesModel = new UbicacionesModel();

        if(isset($_POST['cod_provincia'])&&isset($_POST['cod_canton'])&&$_POST['cod_canton']!=""&&$_POST['cod_provincia']!="")
        {
            return json_encode($ubicacionesModel->distritos($_POST['cod_provincia'], $_POST['cod_canton']));
        }

        return json_encode(false);
    }//Fin de validacion

    /**Obtener todos los distritos para un canton */
    public function barrios()
    {
        $ubicacionesModel = new UbicacionesModel();

        if(isset($_POST['cod_provincia'])&&isset($_POST['cod_canton'])&&isset($_POST['cod_distrito'])&&$_POST['cod_canton']!=""&&$_POST['cod_provincia']!="")
        {
            $ubicacionesModel->where('cod_provincia', $_POST['cod_provincia'])->where('cod_canton', $_POST['cod_canton'])->where('cod_distrito', $_POST['cod_distrito']);

            return json_encode($ubicacionesModel->getAll());
        }//Fin de validacion

        return json_encode(false);
    }//Fin de la funcion
}
