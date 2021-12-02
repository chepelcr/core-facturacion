<?php 
	/**
	* Descripción: Controlador para la entidad Rol
	*/

namespace App\Controllers;

use App\Models\PuntosVentaModel;

class Inicio extends BaseController
	{
		/** Devolver el dash de la aplicacion */
		public function index()
		{
			if(is_login())
			{
				$nombreVista = 'inicio/dash';

				$dataHead = array(
					'head'=>''
				);

				$titulo = 'Modas Laura';
				$objeto = 'Sitema de costos';
				$pagina = 'Inicio';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

				$script = '<!-- Documentos -->
				<script src="'.getFile('dist/js/inicio.js').'"></script>';

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataHead'=>$dataHead,
					'dataHeader'=>$dataHeader,
					'script'=>$script
				);
	
				return view('layout', $data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion index
	}//Fin de la clase
?>