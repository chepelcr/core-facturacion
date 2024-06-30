<?php 
	/**
	* Descripción: Controlador para la entidad Sucursal
	*/

namespace App\Controllers;

use App\Models\DocumentoModel;
use App\Models\InventarioDetalleModel;
use App\Models\PuntosVentaModel;
use App\Models\SucursalesModel;
use App\Models\UbicacionesModel;

class Sucursal extends BaseController
	{
		protected $isModulo = true;

		protected $modelName = 'sucursales';
		
		protected $objetos = ['inventarioDetalle', 'documentos'];
		
		/** Devolver el inventario de la sucursal del usuario */
		public function index()
		{
			if(is_login())
			{
				$nombreVista = 'sucursal/inventario/table';

				$titulo = 'Sucursal';
				$objeto = 'Inventario';
				$pagina = 'Detalle';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

                $head = '<!--DataTables-->
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

                <!-- Documentos -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>
                
                <!-- Documentos -->
				<script src="'.getFile('dist/js/sucursal/inventario.js').'"></script>';

                $inventarioDetalleModel = new InventarioDetalleModel();
                $inventarioDetalleModel->where('id_sucursal', getSession('id_sucursal'));

                $inventario_detalle = $inventarioDetalleModel->getAll();

                $dataHead = array(
					'head'=>$head
				);

				$nombreForm = 'sucursal/inventario/form';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);

                $dataView = array(
                    'inventario_detalle'=>$inventario_detalle,
					'dataModal'=>$dataModal
                );

				$data = array(
					'nombreVista'=>$nombreVista,
                    'dataView' =>$dataView,
					'dataHead'=>$dataHead,
					'dataHeader'=>$dataHeader,
					'script'=>$script
				);
	
				return view('layout', $data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la fucion para devolver el inventario

		public function documentos()
		{
			if(is_login())
			{
				$nombreVista = 'documentos/listado';

				$head = '<!--DataTables-->
					<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
				
					<!--Estilos-->
					<link rel="stylesheet" type="text/css" href="'.baseUrl('dist/css/estilos.css').'">';

				$script = '<!--DataTables-->
					<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
					
					<!-- Listado -->
					<script src="'.getFile('dist/js/listado.js').'"></script>';

				$documentosModel = new DocumentoModel();
				$documentosModel->where('id_sucursal', getSession('id_sucursal'));

				$documentos = $documentosModel->getAll();

				$dataView = array(
					'documentos'=>$documentos,
				);

				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Sucursal';
				$objeto = 'Documentos';
				$pagina = 'Emitidos';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataView'=>$dataView,
					'dataHead'=>$dataHead,
					'dataHeader'=>$dataHeader,
					'script'=>$script
				);

				return view('layout', $data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para retornar los documentos de la sucursal

		/** Guardar una sucursal en la base de datos */
		public function guardar($objeto = null)
		{
			if(is_login())
			{
				$estado = 0;
				$result = 0;

                if(post('estado'))
				{
					$estado = 1;
				}//Fin del if

                $data = array(
                    'nombre_sucursal'=>post('nombre_sucursal'),
                    'id_ubicacion'=>post('id_ubicacion'),
					'otras_senias'=>post('otras_senias'),
                    'activo'=>$estado
                );

                $sucursalesModel = new SucursalesModel();
                $result = $sucursalesModel->insert($data);

				return json_encode($result);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para agregar un rol

		/**Actualizar la informacion de una sucursal*/
		public function update($objeto = null)
		{
			if(is_login())
			{
				$estado = 0;
				$result = 0;

				$id = post('id_sucursal');

				$result = 0;

                if(post('estado'))
				{
					$estado = 1;
				}//Fin del if

                

                $sucursalesModel = new SucursalesModel();
                //$result = $sucursalesModel->update($data, $id);

				return $result;
			}//Fin de la validacion de login

			else
				header('Location: '.baseUrl());
		}//Fin del metodo para actualizar una sucursal

		/**Obtener el inventario de la sucursal en la que el usuario ha iniciado sesion */
		public function inventario()
		{
			if(is_login())
			{
				
			}//Fin de la validacion
		}
	}
?>