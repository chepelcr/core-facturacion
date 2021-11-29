<?php 
	/**
	* Descripción: Controlador para la entidad libro
	*/

	namespace App\Controllers;

	class Compras extends BaseController
	{
		public function index()
		{
			$nombreVista = 'lotes/compras/listado';
			$nombreForm = 'lotes/compras/form';

			$lotes = array();

			$head = '<!--DataTables-->
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';


				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>

				<!-- Articulos -->
				<script src="'.getFile('dist/js/lotes/produccion.js').'"></script>';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);

				$dataView = array(
					'dataModal'=>$dataModal,
					'lotes'=>$lotes,
				);

				$dataHead = array(
					'head'=>$head
				);

				$dataHeader = array(
					'titulo'=>'Materia prima',
					'objeto'=>'Lotes',
					'pagina'=>'Reporte'
				);

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataHeader'=>$dataHeader,
					'dataView'=>$dataView,
					'dataHead'=>$dataHead,
					'script'=>$script
				);
	
				return view('layout', $data);

		}

		/**Obtener los productos utilizados en la creacion de lotes */
		public function productos()
		{
				$nombreVista = 'producto/compras/listado';
				$nombreForm = 'producto/compras/form';

				$productos = array();
				
				$head = '<!--DataTables-->
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';


				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>

				<!-- Articulos -->
				<script src="'.getFile('dist/js/compras/productos.js').'"></script>';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);

				$dataView = array(
					'dataModal'=>$dataModal,
					'articulos'=>$productos,
				);

				$dataHead = array(
					'head'=>$head
				);

				$dataHeader = array(
					'titulo'=>'Materia prima',
					'objeto'=>'Productos',
					'pagina'=>'Listado'
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