<?php

use Core\Permisos\PermisosModel;

    /**Obtener los modulos de un rol */
    function getModulos()
    {
        $modulos = array(
            'empresa'=>['informacion'],
            'produccion'=>['productos', 'lotes'],
            'compras'=>['productos', 'lotes'],
            'seguridad'=>['roles', 'usuarios', 'auditorias']
        );

        /**if(is_login())
        {
            $permisosModel = new PermisosModel();

            $modulos = $permisosModel->modulos(getSession('id_rol'));
        }//Fin de la validacion*/

        return $modulos;
    }//Fin de la funcion para obtener los modulos de un rol

    /**Validar si un usuario tiene acceso a un modulo */
    function validar_permiso($modulo, $objeto, $accion)
    {
        $permiso = false;

        if(is_login())
        {
            $permisosModel = new PermisosModel();

            $permiso = $permisosModel->consultar_accion(getSession('id_rol'), $modulo, $objeto, $accion);
        }//Fin de la validacion de login

        return $permiso;
    }//Fin de la funcion