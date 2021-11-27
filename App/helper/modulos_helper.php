<?php

use Core\Permisos\PermisosModel;

    /**Obtener los modulos de un rol */
    function getModulos()
    {
        $permisosModel = new PermisosModel();

        if(is_login())
        {
            return $permisosModel->modulos(getSession('id_rol'));
        }//Fin de la validacion

        else
        {
            return $permisosModel->modulos(0);
        }//Fin de la validacion
    }//Fin de la funcion para obtener los modulos de un rol

    /**Validar si un usuario tiene acceso a un modulo */
    function validar_permiso($modulo, $objeto, $accion)
    {
        //return true;
        
        $modulos = getModulos();

        foreach ($modulos as $nombre_modulo => $submodulos) 
        {
            //Si el nombre del modulo es igual al modulo que se esta buscando
            if($nombre_modulo == $modulo)
            {
                if(isset ($submodulos[$objeto])&& in_array($accion, $submodulos[$objeto]))
                {
                    return true;
                }//Fin de la validacion
            }
        }
        
        return false;
    }//Fin de la funcion