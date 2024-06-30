<?php
	/**
	* Controlador para la entidad cliente
	*/

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\CodigosPaisesModel;
use App\Models\TipoIdentificacionModel;
use App\Models\UbicacionesModel;

class Especialidad extends BaseController
	{
		public function index()
		{
			if(is_login())
			{
				$nombreVista = 'especialidad/listado';
				
				$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/listado.js').'"></script>

				<!-- Clientes -->
				<script src="'.getFile('dist/js/clientes.js').'"></script>';

				$nombreForm = 'cliente/form';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);

				$dataView = array(
					'dataModal'=>$dataModal
				);

				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Departamentos';
				$objeto = 'Especialidades';
				$pagina = 'Listado';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataView'=>$dataView,
					'dataHeader'=>$dataHeader,
					'dataHead'=>$dataHead,
					'script'=>$script
				);
	
				return view('layout', $data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para mostrar el listado
	}//Fin de la clase
?>