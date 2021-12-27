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
    function validar_permiso($v_modulo, $v_objeto, $v_accion)
    {
        //return true;
        
        $modulos = getModulos();

        foreach ($modulos as $modulo) 
        {
            $nombre_modulo = $modulo->nombre_modulo;
            //Si el nombre del modulo es igual al modulo que se esta buscando
            if($nombre_modulo == $v_modulo)
            {
                $submodulos = $modulo->submodulos;

                foreach ($submodulos as $submodulo) 
                {
                    $nombre_submodulo = $submodulo->nombre_submodulo;
                    //Si el nombre del submodulo es igual al submodulo que se esta buscando
                    if($nombre_submodulo == $v_objeto)
                    {
                        $acciones = $submodulo->acciones;

                        foreach ($acciones as $accion) 
                        {
                            $nombre_accion = $accion->nombre_accion;
                            //Si el nombre de la accion es igual a la accion que se esta buscando
                            if($nombre_accion == $v_accion)
                            {
                                return true;
                            }//Fin de la validacion
                        }//Fin del foreach
                    }//Fin de la validacion
                }//Fin del foreach
            }
        }
        
        return true;
    }//Fin de la funcion