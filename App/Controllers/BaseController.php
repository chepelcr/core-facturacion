<?php
    
namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\DocumentoModel;
use App\Models\UbicacionesModel;
use Core\Controller;
use Core\Model;

class BaseController extends Controller
{
    protected $helpers = ['login', 'modulos', 'facturacion'];

    public function inicio($data = array())
    {
        $data = (object) $data;

        if(is_login())
        {
            $data->modulos = getModulos();

            return view('layout', $data);
        }//Fin de la validacion

        else
            header('Location: '.baseUrl('login'));
    }//Fin de la funcion index

    protected function listado($data)
    {
        return view('base/listado', $data);
    }
}//Fin de la clase
