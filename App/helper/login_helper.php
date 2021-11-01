<?php
	/** Validar si el usuario ha iniciado sesion */
    function is_login()
    {
		return getSession();
		//return true;
    }//Fin de la validacion para el login

	/**Generar una contraseña aleatoriamente */
	function generar_password_complejo($largo)
	{
		$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$cadena_base .= '0123456789' ;
		$cadena_base .= '!@#%&*';
		  
		$password = '';
		$limite = strlen($cadena_base) - 1;
		  
		for ($i=0; $i < $largo; $i++)
		  $password .= $cadena_base[rand(0, $limite)];
		  
		return $password;
	}//Fin del metodo para generar una contraseña aleatoriamente