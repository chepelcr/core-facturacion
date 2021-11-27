<?php
    namespace App\Models;

use Core\Model;

class ContraseniaModel extends Model
    {
        protected $nombreTabla = 'contrasenia_usuarios';
        protected $pk_tabla = 'id_contrasenia';

        protected $dbGroup = 'seguridad';

        protected $camposTabla = [
            'id_usuario',
            'contrasenia',
            'fecha_expiracion',
            'intentos_fallidos',
            'bloqueado',
            'fecha_bloqueo',
            'fecha_desbloqueo',
            'fecha_creacion',
            'fecha_modificacion',
            'fecha_eliminacion',
            'estado'
        ];

        protected $autoIncrement = true;

        protected $auditorias = true;
    }