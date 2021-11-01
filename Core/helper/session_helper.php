<?php
session_start();

/**Obtener el estado de la sesion del usuario, o una variable de la sesion del usuario 
 * @param mixed $name
 * @return bool|mixed
*/
function getSession($name = false)
{
    if(isset($_SESSION[baseUrl()]))
    {
        if(!$name)
            return $_SESSION[baseUrl()];

        if(isset($_SESSION[baseUrl($name)]))
            return $_SESSION[baseUrl($name)];
    }

    return false;
}//Fin del metodo para obtener la sesion de la aplicacion

function setDataSession($data)
{
    $_SESSION[baseUrl()] = true;

    foreach ($data as $campo => $valor) {
        $_SESSION[baseUrl($campo)] = $valor;
    }//Fin del ciclo para crear la sesion con data
}

function destroy()
{
    $_SESSION[baseUrl()] = null;
}//Fin del metodo para destruir una sesion
