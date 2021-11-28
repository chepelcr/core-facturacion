<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Models\RolesModel;
use App\Models\UbicacionesModel;
use App\Models\UsuariosModel;
use Core\Auditorias\AuditoriaModel;
use Core\Auditorias\ErroresModel;
use Core\Permisos\PermisosModel;
use Core\Permisos\SubmodulosAccionesModel;

/**
 * Descripción: Controlador para la entidad usuario
 */
class Seguridad extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'seguridad';
		
	protected $objetos = ['usuarios', 'roles'];

	protected $campos_validacion = array(
		'usuarios'=>'cedula_usuario',
		'roles'=>'nombre_rol'
	);

	protected $validacion_login = array(
		'usuarios'=> true,
		'roles'=> true,
	);

	/**Ontener todos los usuarios del sistema */
	public function index()
	{
		if(!is_login())
			return redirect(baseUrl('login'));

		$usuariosModel = new UsuariosModel();
		$usuarios = $usuariosModel->getAll();

		$nombreVista = 'seguridad/usuario/listado';

		$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

		$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>

				<!-- Ubicaciones -->
				<script src="' . getFile('dist/js/base/ubicaciones.js') . '"></script>
				
				<!-- Usuarios -->
				<script src="' . getFile('dist/js/seguridad/usuarios.js') . '"></script>';

		$nombreForm = 'seguridad/usuario/form';

		$dataModal = array(
			'nombreForm' => $nombreForm,
		);

		$dataView = array(
			'usuarios' => $usuarios,
			'dataModal' => $dataModal
		);

		$dataHead = array(
			'head' => $head
		);

		$titulo = 'Seguridad';
		$objeto = 'Usuarios';
		$pagina = 'Listado';

		$dataHeader = array(
			'titulo' => $titulo,
			'objeto' => $objeto,
			'pagina' => $pagina
		);

		$data = array(
			'nombreVista' => $nombreVista,
			'dataView' => $dataView,
			'dataHead' => $dataHead,
			'dataHeader' => $dataHeader,
			'script' => $script
		);

		return view('layout', $data);
	} //Fin de la funcion para retornar los usuarios del sistema

	/**Obtener todos los roles del sistema */
	public function roles()
	{
			$rolesModel = new RolesModel();
			$roles = $rolesModel->getAll();

			$nombreVista = 'seguridad/rol/listado';
			$nombreForm = 'seguridad/rol/form';

			$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';
			$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>
				
				<!-- Roles -->
				<script src="' . getFile('dist/js/seguridad/rol.js') . '"></script>';

			$dataModal = array(
				'nombreForm' => $nombreForm,
			);

			$dataView = array(
				'dataModal' => $dataModal,
				'roles' => $roles,
			);

			$dataHead = array(
				'head' => $head
			);

			$titulo = 'Sucursal';
			$objeto = 'Usuarios';
			$pagina = 'Roles';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataView' => $dataView,
				'dataHead' => $dataHead,
				'dataHeader' => $dataHeader,
				'script' => $script
			);

			return view('layout', $data);
	} //Fin de la funcion

	/**Obtener el perfil de un usuario */
	public function perfil()
	{
		if (is_login()) {
			$usuariosModel = new UsuariosModel();
			$perfil = $usuariosModel->getById(getSession('id_usuario'));

			$script = '<!-- Contrasenia-->
					<script src="' . getFile('dist/js/seguridad/contrasenia.js') . '"></script>

					<!-- Perfil de usuario -->
					<script src="' . getFile('dist/js/seguridad/perfil.js') . '"></script>';

			$titulo = 'Seguridad';
			$objeto = 'Perfil';
			$pagina = 'Informacion';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$dataForm = array(
				'nombreForm' => 'seguridad/perfil/contrasenia'
			);

			$dataView = array(
				'perfil' => $perfil,
				'dataForm' => $dataForm,
			);

			$data = array(
				'nombreVista' => 'seguridad/perfil/perfil',
				'dataView' => $dataView,
				'dataHeader' => $dataHeader,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion

		else
			header('Location: ' . baseUrl());
	}//Fin de la funcion para retornar el perfil del usuario

	/**Mostrar las acciones de la base de datos */
	public function auditorias()
	{
		if (is_login()) {
			$auditoriaModel = new AuditoriaModel();

			$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

			$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>

				<script>
				$(document).on("click", "#btnAgregar", function(e) {
					e.preventDefault();
			
					mensajeAutomatico("Atencion", "Funcionalidad a implementar", "info");
				});
				</script>';

			$dataView = array(
				'auditorias' => $auditoriaModel->getAll(),
			);


			$dataHead = array(
				'head' => $head
			);

			$titulo = 'Seguridad';
			$objeto = 'Auditorias';
			$pagina = 'Listado';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$data = array(
				'nombreVista' => 'seguridad/auditoria/listado',
				'dataView' => $dataView,
				'dataHeader' => $dataHeader,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion

		return redirect(baseUrl());
	} //Fin de la funcion para mostrar el listado de auditorias

	/**Obtener los errores del sistema */
	public function errores()
	{
			$erroresModel = new ErroresModel();

			$errores = $erroresModel->getAll();

			$nombreVista = 'seguridad/auditoria/errores';

			$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

			$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>';

			$dataView = array(
				'errores' => $errores,
			);

			$dataHead = array(
				'head' => $head
			);

			$titulo = 'Seguridad';
			$objeto = 'Auditorias';
			$pagina = 'Errores';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataView' => $dataView,
				'dataHeader' => $dataHeader,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
	} //Fin de la funcion para mostrar todos los errores

	/**Actualizar un objeto de la base de datos */
	public function update($id, $objeto = null)
	{
		if(is_login())
		{
			if($id == 'perfil' || $id == 'contrasenia')
				$objeto = 'usuarios';
			
			if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
				switch ($objeto) {
					case 'usuarios':
						switch ($id) {
							case 'perfil':
								$id = getSession('id_usuario');

								$data = array(
									'nombre' => post('nombre'),
									'nombre_usuario' => post('nombre_usuario'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
								);
	
								$model = $this->model('usuarios');
	
								if($model->update($data, $id)!=0)
								{
									setSession('nombre', post('nombre'));
									setSession('nombre_usuario', post('nombre_usuario'));
									setSession('correo', post('correo'));
									setSession('telefono', post('telefono'));
	
									return json_encode(array(
										'estado' => 1,
									));
								}//Fin de validacion de operacion

								else
									return json_encode(array(
										'error' => 'No se pudo actualizar el perfil',
									));
							break;

							case 'contrasenia':
								$id = getSession('id_usuario');

								return $this->actualizar_contrasenia($id, post('contra_nueva_conf'), post('contra_actual'));
							break;
							
							default:
								//Si el usuario no tiene permisos para modificar
								if(!validar_permiso($this->nombre_modulo, 'usuarios', 'modificar'))
									return json_encode(array(
										'error' => 'No tiene permisos para realizar esta acción.',
									));
								
								$data = array(
									'nombre' => post('nombre'),
									'nombre_usuario' => post('nombre_usuario'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_rol' => post('id_rol'),
									'id_sucursal' => post('id_sucursal')
								);
							break;
						}//Fin del switch de id
					break;

					case 'roles':

						$data = array(
							'nombre_rol' => post('nombre_rol'),
						);
					break;
				} //Fin del switch

				if ($id) {
					if(!validar_permiso($this->nombre_modulo, $objeto, 'modificar'))
						return json_encode(array(
							'error' => 'No tiene permisos para realizar esta acción.',
						));
					
					$model = $this->model($objeto);
					$id = $model->update($data, $id);

					/**Si el id es diferente de 0 */
					if ($id != 0) {
						return json_encode(array(
							'estado' => '1',
						));
					} //Fin de la validacion del id

					/**Si el id es 0 */
					else {
						$error = $model->getError();

						return json_encode(array(
							'error' => $error['sentencia'],
						));
					} //Fin de la validacion del id
				} //Fin de la validacion del id
			} //Fin de la validacion

			else
				return json_encode(array(
					'error' => 'No se pudo actualizar el objeto',
				));
		}//Fin de la validacion de sesion

		return redirect(baseUrl());
	} //Fin del metodo para actualizar un objeto

	/**Guardar un objeto en la base de datos */
	public function guardar($objeto = null)
	{
		if(is_login())
		{
			if (!is_null($objeto) && in_array($objeto, $this->objetos)) 
			{
				$model = $this->model($objeto);

				switch ($objeto) 
				{
					case 'usuarios':
						//Validar el permiso de acceso
						if(validar_permiso($this->nombre_modulo, 'usuarios', 'insertar'))
						{
							if ($this->validarUsuario(post('cedula_usuario'))) 
							{
								return json_encode(array(
									'error' => 'El usuario indicado ya se encuentra registrado',
								));
							} //Fin de validacion de cedula

							else 
							{
								$data = array(
									'cedula_usuario' => post('cedula_usuario'),
									'nombre' => post('nombre'),
									'nombre_usuario' => post('nombre_usuario'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_rol' => post('id_rol'),
									'id_sucursal' => post('id_sucursal')
								);

								$id = $model->insert($data);

								if ($id != 0) 
								{
									$pass = generar_password_complejo(10);
									//$pass = 1234;

									$data_pass = array(
										'id_usuario' => $id,
										'contrasenia' => encriptar_texto($pass),
										'fecha_expiracion' => date('Y-m-d H:i:s'),
										'estado' => 1
									);

									$model = $this->model('contrasenia');

									$id_contrasenia = $model->insert($data_pass);

									//Si el id de la contraseña es mayor a cero, se envia el correo
									if ($id_contrasenia != 0) 
									{
										$mensaje = 'Estimado ' . post('nombre') . ',
											<br>
											
											Se ha completado su registro en la plataforma de inventario. <br> Su usuario es <b>' . post('correo') . '</b> y su contraseña es <b>' . $pass . '</b>. 
											Debe realizar el cambio de la contraseña la primera vez que inicia sesión.';

										$data = array(
											'receptor' => post('correo'),
											'asunto' => 'Registro de usuario',
											'body' => $mensaje
										);

										$correo = new Correo();

										if ($correo->enviarCorreo($data))
											return json_encode(array(
												'success' => 'El usuario se ha registrado correctamente',
											));
										else
											return json_encode(array(
												'error' => 'No se pudo enviar el correo, debe indicar contraseña manualmente: ' + $pass,
											));
									} //Fin de validacion de id_contrasenia

									else
										return json_encode(array(
											'error' => 'No se pudo guardar la contraseña.',
										));
								}//Fin de validacion de id

								else
									return json_encode(array(
										'error' => 'No se pudo guardar el usuario.',
									));
							} //Fin de validacion de cedula
						}//Fin de validacion de permiso

						else
							return json_encode(array(
								'error' => 'No tiene permisos para realizar esta acción.',
							));
					break;

					case 'roles':
						$data = array(
							'nombre_rol' => post('nombre_rol'),
						);

						$id = $model->insert($data);

						if ($id != 0) 
						{
							$submodulos_acciones_model = new SubmodulosAccionesModel();

							$submodulos_acciones = $submodulos_acciones_model->getAll();

							foreach ($submodulos_acciones as $submodulo_accion) 
							{
								//var_dump($submodulo_accion);

								$data = array(
									'id_rol' => $id,
									'id_modulo' => $submodulo_accion->id_modulo,
									'id_submodulo' => $submodulo_accion->id_submodulo,
									'id_accion' => $submodulo_accion->id_accion,
								);

								$model = new PermisosModel();

								$model->insert($data);
							}//Fin del ciclo
							
							return json_encode(array(
								'success' => 'El rol se ha registrado correctamente',
							));
						} //Fin de validacion de id

						else
							return json_encode(array(
								'error' => 'No se pudo guardar el rol.',
							));
					break;
				} //Fin del switch
			} //Fin de la validacion

			return json_encode(array(
				'error' => 'Se ha generado un error en la solicitud',
			));
		}//Fin de la validacion de login

		else
			return redirect(baseUrl());
	} //Fin del metodo para guardar un objeto

	/**Cambiar la contrasenia de un usuario */
	private function actualizar_contrasenia($id, $pass, $old_pass)
	{
		$id_usuario = $id;

		$model = $this->model('contrasenia');

		$contrasenia = $model->where('id_usuario', $id_usuario)->fila();

		//Si la contrasenia actual es correcta
		if ($old_pass == desencriptar_texto($contrasenia->contrasenia)) {
			//Si la nueva contrasenia es igual a la actual
			if ($pass == desencriptar_texto($contrasenia->contrasenia))
				return json_encode(array(
					'error' => 'La nueva contraseña no puede ser igual a la actual',
				));

			elseif (validar($pass)) {
				$data = array(
					'contrasenia' => encriptar_texto($pass),
					'fecha_expiracion' => date('Y-m-d H:i:s', strtotime('+1 year')),
					'estado' => 1
				);

				$model = $this->model('contrasenia');

				$id = $model->update($data, $contrasenia->id_contrasenia);

				if ($id != 0) {
					setSession('contrasenia_expiro', false);
					
					$model = $this->model('usuarios');

					$usuario = $model->getById($id_usuario);

					$correo = $usuario->correo;

					$mensaje = 'Estimado ' . $usuario->nombre . ',
							<br>
							
							Se ha cambiado su contraseña en la plataforma de inventario. <br> Su nueva contraseña es <b>' . $pass . '</b>.';

					$data = array(
						'receptor' => $correo,
						'asunto' => 'Cambio de contraseña',
						'body' => $mensaje
					);

					$correo = new Correo();

					if ($correo->enviarCorreo($data))
						return json_encode(array(
							'estado' => '1',
						));

					else
						return json_encode(array(
							'error' => 'No se pudo enviar el correo',
						));
				}//Fin de validacion de envio

				else
					return json_encode(array(
						'error' => 'No se pudo cambiar la contraseña',
					));
			}//Fin de validacion de contrasenia nueva

			else
				return json_encode(array(
					'error' => 'La contraseña no cumple con los requisitos',
				));
		}//Fin de validacion de contrasenia correcta

		else
			return json_encode(array(
				'error' => 'La contraseña actual no es correcta',
			));
	} //Fin del metodo para cambiar la contrasenia

	/**Enviar una contraseña temporal a un usuario */
	public function enviar_contrasenia()
	{
		if(getSegment(3))
		{
			//Validar permiso
			if(!validar_permiso($this->nombre_modulo, 'usuarios', 'modificar'))
				return json_encode(array(
					'error' => 'No tiene permisos para realizar esta acción.',
				));

			$id_usuario = getSegment(3);

			$model = $this->model('usuarios');
			$usuario = $model->getById($id_usuario);

			if($usuario)
			{
				$estado = enviar_contrasenia_temporal($usuario);

				if($estado==1)
					return json_encode(array(
						'estado'=>1,
					));

				else
					return json_encode(array(
						'error'=>$estado,
					));
			}//Fin de validacion de usuario

			else
				return json_encode(array(
					'error' => 'No se encontro el usuario',
				));
		}

		else
			return json_encode(array(
				'error' => 'No se ha indicado el usuario',
			));
	}//Fin del metodo para enviar una contraseña temporal

	/**Validar si un usuario ya se encuentra registrado */
	private function validarUsuario($cedula)
	{
		$usuariosModel = new UsuariosModel();

		$usuariosModel->where('cedula_usuario', $cedula);

		if ($usuariosModel->fila())
			return true;

		return false;
	} //Fin de la funcion para validar si un usuario existe
}//Fin de la clase