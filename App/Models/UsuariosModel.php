<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class UsuariosModel extends Model {
	protected $nombreTabla = 'usuarios';
	protected $vistaTabla = 'usuarios_view';

	protected $pk_tabla = 'id_usuario';
	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'nombre',
		'nombre_usuario',
		'identificacion',
		'id_tipo_identificacion',
		'correo',
		'id_rol',
		'cod_pais',
		'id_empresa',
		'telefono',
		'fecha_registro',
		'fecha_actualizacion',
		'fecha_eliminacion',
		'estado'
	];

	protected $camposVista = [
        'tipo_identificacion',
        'codigo_telefono',
        'nombre_pais',
		'nombre_empresa',
		'nombre_rol',
    ];

	protected $autoIncrement = true;
	protected $auditorias = true;

	/**Obtener usuarios del sistema */
	public function obtener($id)
	{
		switch($id) {
			case 'all':
				return $this->getAll();
			break;

			case 'perfil':
				return $this->getPerfil();
			break;

			default:
				return $this->getById($id);
			break;
		}
	}//Fin del método obtener

	/**Obtener el perfil de un usuario */
	public function getPerfil()
	{
		return $this->getById(getSession('id_usuario'));
	}
}//Fin de la clase