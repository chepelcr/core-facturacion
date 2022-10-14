<?php

/**
 * Descripción: Controlador para la entidad Rol
 */

namespace App\Controllers;


class Configuracion extends BaseController
{
	/** Devolver el dash de la aplicacion */
	public function index()
	{
		if (is_login()) {
			$script = '<script>
					$(document).ready(function(){
						setTimeout(function(){
							cargar_inicio_modulo("configuracion");
						}, 5000);
					});
				</script>';

			$data = array(
				'script' => $script,
			);

			return $this->inicio($data);
		} //Fin de la validacion

		else
			header('Location: ' . baseUrl('login'));
	} //Fin de la funcion index

	/**
	 * Entrar a la configuracion del modulo de administracion
	 */
	public function empresa()
	{
		if (is_login()) {
			$script = "";

			if (validar_permiso("configuracion", "empresa", "consultar")) {
				if (getSegment(3) == "listado") {
					return view('seguridad/configuracion/empresa');
				}

				$script .= '<!-- Perfil de empresa -->
							<script type:text/javascript>
								$(document).ready(function() {
									cargar_listado("configuracion", "empresa", "Configuración", "Empresa", "' . baseUrl("configuracion/empresa/listado") . '");
								});
							</script>';
			}

			if (getSegment(3) == "listado") {
				return json_encode(array(
					'error' => 'No tiene permisos para acceder a la página.'
				));
			}

			$data = array(
				'script' => $script
			);

			return $this->inicio($data);
		} else {
			if (getSegment(3) == "listado") {
				return json_encode(array(
					'error' => 'No ha iniciado sesión.',
					'login' => false
				));
			}

			header('Location: ' . baseUrl('login'));
		}
	} //Fin de la función empresa

	/**
	 * Entrar a la configuracion del modulo de facturacion
	 */
	public function facturacion()
	{
		if (is_login()) {
			$script = "";

			if (validar_permiso("configuracion", "documentos", "consultar")) {
				if (getSegment(3) == "listado") {
					return view('seguridad/configuracion/facturacion');
				}

				$script .= '<!-- Perfil de empresa -->
							<script type:text/javascript>
								$(document).ready(function() {
									cargar_listado("configuracion", "documentos", "Configuración", "Facturacion", "' . baseUrl("configuracion/facturacion/listado") . '");
								});
							</script>';
			}

			if (getSegment(3) == "listado") {
				$error = array(
					'error' => 'No tiene permisos para acceder a la pagina.',
					'codigo' => 403
				);

				return $this->error($error);
			}

			$data = array(
				'script' => $script
			);

			return $this->inicio($data);
		} else {
			if (getSegment(3) == "listado") {
				$error = array(
					'error' => 'login',
					'codigo' => 403
				);

				return $this->error($error);
			}

			header('Location: ' . baseUrl('login'));
		}
	} //Fin del metodo para entrar a la configuracion del modulo de facturacion
}//Fin de la clase
