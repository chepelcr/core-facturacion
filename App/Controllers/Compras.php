<?php 
	/**
	* Descripción: Controlador para la entidad libro
	*/

	namespace App\Controllers;

	class Compras extends BaseController
	{
		protected $nombre_modulo = 'compras';

		protected $objetos = [
			'productosCompra',
			'lotesCompra',
		];

		protected $validacion_login = array(
			'lotesCompra' => true,
			'productosCompra'=> true,
		);

		/**Obtener los lotes de compra de la empresa */
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

		/**Obtener los productos catalogados como materia prima */
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

		/** Guardar un objeto en la base de datos */ 
		public function guardar($objeto = null)
		{
			if(is_login())
			{
				if(!is_null($objeto) && in_array($objeto, $this->objetos)) 
				{
					$model = $this->model($objeto);

					switch($objeto)
					{
						case 'productos':
							//Validar el permiso de acceso
							if(validar_permiso($this->nombre_modulo, 'productos', 'insertar'))
							{
								$data = array(
									'descripcion' => post('descripcion'),
								);
							}
						break;
					}
				}
			}
		}//Fin de la funcion guardar
	}//Fin de la clase
?>