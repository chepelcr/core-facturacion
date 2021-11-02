<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Models\UsuariosModel;
use Core\Permisos\PermisosModel;

/** Clase para iniciar sesion en la aplicacion */
class Login extends BaseController
	{
		/** Funcion para mostrar el login */
		public function index()
		{
			if(!is_login())
			{
				//Cargar el login
				return view('seguridad/login/login');
			}//Fin del if

			else
			{
				header('Location: '.baseUrl('punto'));
			}//Fin del else
		}//Fin de la funcion

		/** Funcion para consultar si el usuario existe en la base de datos */
		public function consultar()
		{
			$respuesta = 0;

			//Validar si el usuario ha iniciado sesion
			if (!is_login())
			{
				$user = $_POST['usuario'];
				$pswd = $_POST['contrasenia'];

				$usuariosModel = new UsuariosModel();

				$usuariosModel->where('correo', $user);
				$usuariosModel->where('contrasenia', $pswd);
			
				$usuario = $usuariosModel->fila();

				if($usuario)
				{
					$data = array(
						'id_usuario'=>$usuario->id_usuario,
						'nombre_usuario'=>$usuario->nombre_usuario,
						'id_rol'=>$usuario->id_rol,
						'id_empresa'=>$usuario->id_empresa,
						'id_sucursal'=>$usuario->id_sucursal,
					);
					
					setDataSession($data);
					
					$respuesta = 1;
				}//Fin del if

				return json_encode($respuesta);
			}//Fin de la validacion
			
			else
				header('Location: '.baseUrl('punto'));
		}//Fin de la funcion para consultar un usuario

		/**Registrar un nuevo usuario en el sistema */
		public function guardar($objeto = null)
		{
			if(!is_login())
			{
				//Validar terminos y condiciones
				if(post('estado'))
				{
					$correo = $_POST['correo'];
					$pass = generar_password_complejo(10);
	
					if(!$this->validarUsuario($correo))
					{
						$usuariosModel = new UsuariosModel();

						$data = array(
							'cedula_usuario'=>$_POST['cedula_usuario'],
							'nombre'=>$_POST['nombre'],
							'apellido'=>$_POST['apellido'],
							'correo'=>$correo,
							'nombre_usuario'=>$_POST['nombre_usuario'],
							'contrasenia'=>$pass,
							'id_rol'=>2,
							'estado'=>1
						);

						$id = $usuariosModel->insert($data);

						$mensaje = 'Estimado '.$_POST['nombre'].' '.$_POST['apellido'].',
						<br>
						
						Se ha completado su registro en la plataforma. <br> Su usuario es <b>'.$_POST['correo'].'</b> y su contraseña es <b>'.$pass.'</b>. 
						Debe realizar el cambio de una contraseña la primera vez que inicia sesión.';

						$data = array(
							'receptor' => $_POST['correo'],
							'asunto'=>'Registro de usuario',
							'body'=> $mensaje
						);

						$correo = new Correo();

						$correo->enviarCorreo($data);

						return json_encode($id);
					}//Fin de la validacion de correo

					return json_encode(0);
				}//Fin de validacion de correo

				return json_encode(-1);
			}//Fin de la validacion de terminos

			else
			{
				header('Location: '.baseUrl('punto'));
			}//Fin del if
		}//Fin de la funcion

		private function validarUsuario($correo)
		{
			$usuariosModel = new UsuariosModel();

			$usuariosModel->where('correo', $correo);

			if($usuariosModel->fila())
				return true;

			return false;
		}//Fin de la funcion para validar si un usuario existe

		public function salir()
		{
			destroy();

			header('Location: '.baseUrl());
		}//Fin de la funcion


		public function olvido(){
			if(!is_login())
			{
				//Cargar el olvido
				return view('login/olvido');
			}//Fin del if

			else
			{
				header('Location: '.baseUrl('punto'));
			}//Fin del else
		}//Fin de la funcion

		/**Recuperar la contrasenia de un usuario */
		public function recuperar()
		{
			if(!is_login())
			{
				if(post('correo'))
				{
					$correo = $_POST['correo'];
					$pass = generar_password_complejo(10);

					$usuariosModel = new UsuariosModel();

					$usuariosModel->where('correo', $correo);

					$usuario = $usuariosModel->fila();

					//Si el usuario existe inserte la data
					if($usuario)
					{
						$usuariosModel = new UsuariosModel();

						$data = array(
							'contrasenia'=>$pass,
						);

						$id = $usuariosModel->update($data, $usuario->id_usuario);

						$mensaje = 'Estimado '.$usuario->nombre.' '.$usuario->apellido.',
							<br>
							
							Se ha realizado un cambio de contraseña. <br> Su nueva contraseña es <b>'.$pass.'</b>. 
							Debe realizar el cambio de la contraseña la primera vez que inicia sesión.';

						$data = array(
							'receptor' => $correo,
							'asunto'=>'Cambio de clave',
							'body'=> $mensaje
						);

						$correo = new Correo();

						$correo->enviarCorreo($data);

						return $id;
					}//Fin de la validacion del usuario

					return json_encode(0);
				}//Fin de la validacion

				else
					header('Location: '.baseUrl());
			}//Fin de la validacion de logueo

			else
				header('Location: '.baseUrl('punto'));
		}//Fin del metodo para recuperar la contrasenia
	}//Fin del controlador de login

?>