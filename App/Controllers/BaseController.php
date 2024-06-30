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
            if(getSession('contrasenia_expiro'))
			{
                $script = '<script>
                                $(document).ready(function(){
                                    //Esperar 5 segundos para mostrar el modal
                                    setTimeout(function(){
                                        mensajeAutomatico("Atencion", "Su contraseña ha expirado, por favor cambiela.", "warning");
                                        
                                        cambio_contrasenia();
                                    }, 10000);
                                });
                            </script>';
				
                //Si la data tiene un script, concatena el script
                if(isset($data->script))
                    $data->script .= $script;
                else
                    $data->script = $script;
			}

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
