<?php 
	/**
	* Descripción: Controlador para la entidad usuario
	*/

namespace App\Controllers;

use App\Models\RolesModel;
use App\Models\UsuariosModel;

class Usuario extends BaseController
	{
		public function index()
		{
			if(is_login())
			{
				$usuariosModel = new UsuariosModel();
				$usuarios = $usuariosModel->getAll();
				
				$rolesModel = new RolesModel();
				$roles = $rolesModel->getAll();
				
				$nombreVista = 'usuario/listado';
				
				$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/listado.js').'"></script>
				
				<!-- Usuarios -->
				<script src="'.getFile('dist/js/usuarios.js').'"></script>';

				$dataView = array(
					'usuarios'=>$usuarios,
					'roles'=>$roles,
				);

				$dataHead = array(
					'head'=>$head
				);

				$data = array(
					'nombreVista'=>$nombreVista,
					'dataView'=>$dataView,
					'dataHead'=>$dataHead,
					'script'=>$script
				);
	
				return view('layout', $data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para mostrar el listado
		
		/**Verificar si ya existe la cedula de un usuario */
		public function verificar()
		{
			if(is_login())
			{
				if(getSegment(3))
				{
					$cedula = getSegment(3);

					$usuariosModel = new UsuariosModel();

					$usuariosModel->where('cedula_usuario', $cedula);

					$usuario = $usuariosModel->fila();

					return $usuario;
				}

			}//Fin de la validacion
		}

		/** Obtener un usuario por id */
		public function obtener()
		{
			if(is_login())
			{
				$usuariosModel = new UsuariosModel();
				$usuariosModel->where('id_usuario', getSegment(3));

				$usuario = $usuariosModel->fila();

				return json_encode($usuario);
			}//Fin de la validacion
		}//Fin de la funcion

		/**Guardar un usuario en la base de datos */
		public function guardar()
		{
			if(is_login())
			{
				$usuariosModel = new UsuariosModel();

				$estado = 0;

				if(post('estado'))
				{
					$estado = 1;
				}//Fin del if

				$data = array(
					'cedula_usuario'=>post('cedula_usuario'),
					'nombre'=>post('nombre'),
					'apellido'=>post('apellido'),
					'correo'=>post('correo'),
					'nombre_usuario'=>post('nombre_usuario'),
					'contrasenia'=>post('contrasenia'),
					'id_rol'=>post('id_rol'),
					'estado'=>$estado
				);
				
				return json_encode($usuariosModel->insert($data));
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para guardar un usuario

		public function update()
		{
			if(is_login())
			{
				$estado = 0;
				$id_usuario = post('id_usuario');

				if(post('estado'))
				{
					$estado = 1;
				}//Fin del if

				$data = array(
					'cedula_usuario'=>post('cedula_usuario'),
					'nombre'=>post('nombre'),
					'apellido'=>post('apellido'),
					'correo'=>post('correo'),
					'nombre_usuario'=>post('nombre_usuario'),
					'id_rol'=>post('id_rol'),
					'estado'=>$estado
				);

				$usuariosModel = new UsuariosModel();
				return json_encode($usuariosModel->update($data,$id_usuario));
			}//Fin de la validacion

			else
			{
				header('Location: '.baseUrl());
			}//Fin del else
		}//Fin de la funcion para guardar un usuario
	}//Fin de la clase
?>