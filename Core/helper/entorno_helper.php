<?php
use Dotenv\Dotenv;

    /**Obtener una variable de entorno */
    function getEnt($name = false)
    {
        $dotenv = Dotenv::createImmutable('.');
        $dotenv->load();

        if(!$name||!isset($_ENV[$name]))
        {
            return false;
        }

        return $_ENV[$name];
    }//Fin de la funcion

    /**Obtener el ambiente de la aplicacion */
    function getEnviroment()
    {
        return getEnt('app.ambiente');
    }