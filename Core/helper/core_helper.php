<?php

use Core\Model;

/**Obtener un modelo de la aplicacion */
function model($model_name = null)
{
    if(isset($model_name))
    {
        //Poner la primer letra en mayuscula
        $model_name = ucfirst($model_name);

        $model_name = 'App\Models\\' . $model_name.'Model';

        //Crear una instancia del modelo
        $model = new $model_name();
        
        //Validar si el modelo devuelto es una instancia de Model
        if($model instanceof Model)
        {
            return $model;
        }
        else
        {
            return false;
        }
    }

    return false;
}//Fin de la funcion

/**Obtener la localizacion de la aplicacion para almacenar archivos
 * $carpeta: nombre de la carpeta
 * @return string
 */
function location($carpeta = '')
{
    $ambiente = getEnt('app.ambiente');

    if($ambiente == 'desarrollo')
    {
        return getEnt('app.location') . $carpeta;
    }

    else {
        //Transformar todos los \\ en /
        $carpeta = str_replace('\\', '/', $carpeta);

        return getEnt('app.location') . $carpeta;
    }
}