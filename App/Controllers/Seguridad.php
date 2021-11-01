<?php 

namespace App\Controllers;

use App\Models\RolesModel;
use App\Models\UbicacionesModel;
use App\Models\UsuariosModel;
use Core\Auditorias\AuditoriaModel ;
use Core\Auditorias\ErroresModel;

/**
* Descripción: Controlador para la entidad usuario
*/
class Seguridad extends BaseController
	{
		public function index()
		{
				$usuariosModel = new UsuariosModel();
				$usuarios = $usuariosModel->getAll();

				$ubicacionesModel = new UbicacionesModel();
                $provincias = $ubicacionesModel->provincias();
				
				$nombreVista = 'seguridad/usuario/listado';
				
				$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>

				<!-- Ubicaciones -->
				<script src="'.getFile('dist/js/base/ubicaciones.js').'"></script>
				
				<!-- Usuarios -->
				<script src="'.getFile('dist/js/seguridad/usuarios.js').'"></script>';

				$dataProvincias = array(
                    'provincias'=>$provincias
                );

				$nombreForm = 'seguridad/usuario/form';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
					'dataForm'=>array(
						'dataProvincias'=>$dataProvincias,
					)
				);

				$dataView = array(
					'usuarios'=>$usuarios,
					'dataModal'=>$dataModal
					
				);

				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Seguridad';
				$objeto = 'Usuarios';
				$pagina = 'Listado';

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
		}//Fin de la funcion para retornar los usuarios del sistema

		/**Obtener todos los roles del sistema */
		public function roles()
		{
			if(is_login())
			{
				$rolesModel = new RolesModel();
				$roles = $rolesModel->getAll();

				$objeto = 'rol';

				$nombreVista = $objeto.'/listado';
				$nombreForm = $objeto.'/form';

				$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';
				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/listado.js').'"></script>
				
				<!-- Roles -->
				<script src="'.getFile('dist/js/rol.js').'"></script>';

				$dataModal = array(
					'nombreForm'=>$nombreForm,
				);
				
				$dataView = array(
					'dataModal'=>$dataModal,
					'roles'=>$roles,
				);

				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Sucursal';
				$objeto = 'Usuarios';
				$pagina = 'Roles';

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
		}//Fin de la funcion

		public function auditorias()
		{
			if(is_login())
			{
				$auditoriaModel = new AuditoriaModel();

				$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>

				<script>
				$(document).on("click", "#btnAgregar", function(e) {
					e.preventDefault();
			
					mensajeAutomatico("Atencion", "Funcionalidad a implementar", "info");
				});
				</script>';

				$dataView = array(
					'auditorias'=> $auditoriaModel->getAll(),
				);


				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Seguridad';
				$objeto = 'Auditorias';
				$pagina = 'Listado';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

				$data = array(
					'nombreVista' => 'seguridad/auditoria/listado',
					'dataView'=>$dataView,
					'dataHeader'=>$dataHeader,
					'dataHead'=> $dataHead,
					'script'=> $script
				);

				return view('layout', $data);
			}//Fin de la validacion
		}//Fin de la funcion para mostrar el listado de auditorias

		public function errores()
		{
			if(is_login())
			{
				$erroresModel = new ErroresModel();

				$errores = $erroresModel->getAll();
				
				$nombreVista = 'seguridad/auditoria/errores';
				
				$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/base/listado.js').'"></script>';

				$dataView = array(
					'errores'=> $errores,
				);

				$dataHead = array(
					'head'=>$head
				);

				$titulo = 'Seguridad';
				$objeto = 'Auditorias';
				$pagina = 'Errores';

				$dataHeader = array(
					'titulo'=>$titulo,
					'objeto'=>$objeto,
					'pagina'=>$pagina
				);

				$data = array(
					'nombreVista' => $nombreVista,
					'dataView'=>$dataView,
					'dataHeader'=>$dataHeader,
					'dataHead'=> $dataHead,
					'script'=> $script
				);

				return view('layout', $data);
			}//Fin de la validacion
		}//Fin de la funcion para mostrar todos los errores

		public function obtener_error()
		{
			if(is_login())
			{
				$erroresModel = new ErroresModel();
				$error = $erroresModel->getById(getSegment(3));

				return json_decode($error);
			}//Fin de la validacion
		}//Fin de la funcion para obtener un error
	}//Fin de la clase