<?php 
	/**
	* Descripción: Controlador para la entidad libro
	*/

	namespace App\Controllers;

class Produccion extends BaseController
	{
		/**Obtener los productos utilizados en la creacion de lotes */
		public function productos()
		{
				$nombreVista = 'produccion/listado';
				$nombreForm = 'produccion/form';
				
				$head = '<!--DataTables-->
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';


				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>

				<!-- Articulos -->
				<script src="'.getFile('dist/js/produccion/productos.js').'"></script>';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);

				$dataView = array(
					'dataModal'=>$dataModal
				);

				$dataHead = array(
					'head'=>$head
				);

				$dataHeader = array(
					'titulo'=>'Empresa',
					'objeto'=>'Produccion',
					'pagina'=>'Productos'
				);

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataHeader'=>$dataHeader,
					'dataView'=>$dataView,
					'dataHead'=>$dataHead,
					'script'=>$script
				);
	
				return view('layout', $data);
		}//Fin de la funcion para mostrar el listado
	}//Fin de la clase
?>