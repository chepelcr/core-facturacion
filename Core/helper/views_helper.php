<?php
use PHPBook\View as View;

View\Configuration\View::setViewsPathRoot('main', '../App/Views');

View\Configuration\View::setDefaultPathRoot('main');

/**Renderizar una vista */
function view($nombreVista, $data=null)
{
    $view = new View\View;
    $view->setView($nombreVista);

    if($data!=null)
    {
	//extract($data);
        $view->setData($data);
    }

    //$ds = DIRECTORY_SEPARATOR;
    //$base_dir = realpath(dirname(__FILE__)  . $ds . '..'. $ds . '..') . $ds;

    //include_once 'App/views/'.$nombreVista.'.php';

    return $view->render();
}//Fin de la funcion

/**Obtener el nombre de un archivo almacenado en el servidor */
function getFile($name = '')
{
    if($name!='')
    {
        return baseUrl('files/'.$name);
    }

    return false;
}//Fin de la funcion

function getFilesFolder()
{
    return 'files/';
}//Fin de la fución para retornar la carpeta donde se encuentran almacenados los archivos de la aplicacion

/**Obtener una variable desde una solicitud POST */
function post($name = null)
{
    if(!empty($_POST))
    {
        if($name)
        {
            if(isset($_POST[$name]))
                return $_POST[$name];

            return false;
        }
                
        $data = json_encode($_POST);

        return json_decode($data);
    }//Fin de la validacion

    return false;
}//Fin del metodo

/**Obtener una variable desde una solicitud GET */
function get($name = null)
{
    if(!empty($_GET))
    {
        if($name)
        {
            if(isset($_GET[$name]))
                return $_GET[$name];

            return false;
        }
                
        $data = json_encode($_GET);

        return json_decode($data);
    }//Fin de la validacion

    return false;
}//Fin del metodo
