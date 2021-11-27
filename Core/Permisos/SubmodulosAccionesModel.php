<?php
    namespace Core\Permisos;

    use Core\Model;

    /**Manejar los submodulos de la aplicacion */
    class SubmodulosAccionesModel extends Model
    {
        protected $nombreTabla = "submodulos_acciones";

        protected $vistaTabla = 'submodulos_acciones_view';

        protected $dbGroup = 'seguridad';

        protected $camposTabla = [
            'id_modulo',
            'id_submodulo',
            'id_accion',
        ];

        protected $camposVista = [
            'nombre_modulo',
            'nombre_submodulo',
            'nombre_accion',
        ];

        protected $auditorias = true;

    }//Fin de la clase