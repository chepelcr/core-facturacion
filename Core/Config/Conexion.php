<?php
	namespace Core\Config;

	use \PDO;
	
	class Conexion
	{
		private static $instance=NULL;
		
		private function __construct(){}

		private function __clone(){}
		
		public static function getConnect($dbGroup = 'default'){
			//Si el grupo de conexion es el usado por defecto
			if($dbGroup=='default')
			{
				if (!isset(self::$instance)) {
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	
					$host = getEnt('database.'.$dbGroup.'.host');
					$database = getEnt('database.'.$dbGroup.'.name');
	
					$user = getEnt('database.'.$dbGroup.'.user');
					$pswd = getEnt('database.'.$dbGroup.'.pswd');
	
					self::$instance= new PDO('mysql:host='.$host.';dbname='.$database,$user,$pswd,$pdo_options);
				}
			}//Fin de la validacion de grupo

			else
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	
				$host = getEnt('database.'.$dbGroup.'.host');
				$database = getEnt('database.'.$dbGroup.'.name');

				$user = getEnt('database.'.$dbGroup.'.user');
				$pswd = getEnt('database.'.$dbGroup.'.pswd');
	
				self::$instance= new PDO('mysql:host='.$host.';dbname='.$database,$user,$pswd,$pdo_options);
				
			}

			//Retornar la instancia de conexion
			return self::$instance;
		}
	}
?>
