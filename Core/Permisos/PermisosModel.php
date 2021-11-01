<?php

    namespace Core\Permisos;

    use Core\Model;

    /**Manejar los permisos de la aplicacion */
    class PermisosModel extends Model
    {
        protected $nombreTabla = "permisos_submodulos";
        protected $pk_tabla = "id_permiso";

        protected $vistaTabla = 'permisos_view';

        protected $camposTabla = [
            'id_rol',
            'id_modulo',
            'id_submodulo',
            'id_accion',
            'estado',
            'created_at'
        ];

        protected $camposVista = [
            'nombre_rol',
            'nombre_modulo',
            'nombre_submodulo',
            'nombre_accion',
        ];

        protected $autoIncrement = true;

        protected $auditorias = true;

        protected $dbGroup = 'seguridad';

        /**Obtener todos los modulos de un rol */
        public function modulos($id_rol)
        {
            $this->vista('modulos_roles_view')->select('id_modulo')->select('nombre_modulo')->where('id_rol', $id_rol);

            $modulos = $this->getAll();

            $data = [];

            foreach ($modulos as $modulo) {
                $permisosModel = new PermisosModel();

                $data[$modulo->nombre_modulo] = $permisosModel->submodulos($id_rol, $modulo->id_modulo);
            }

            return $data;
        }//Fin de la funcion para obtener los modulos de un rol

        /**Obtener todos los submodulos para un modulo */
        public function submodulos($id_rol, $id_modulo)
        {
            $this->vista('submodulos_roles_view')->select('id_submodulo')->select('nombre_submodulo')->where('id_rol', $id_rol)->where('id_modulo', $id_modulo);
            $submodulos = $this->getAll();

            $data = [];

            foreach ($submodulos as $submodulo) {
                $data[] = $submodulo->nombre_submodulo;
            }

            return $data;
        }//Fin de la funcion

        /**Obtener una accion de un submodulo */
        public function consultar_accion($id_rol, $nombre_modulo, $nombre_submodulo, $nombre_accion)
        {
            $this->where('id_rol', $id_rol)->where('nombre_modulo', $nombre_modulo)->where('nombre_submodulo', $nombre_submodulo)->where('nombre_accion', $nombre_accion);
            
            /**Si se encuentra la fila con el permiso */
            $permiso = $this->fila();

            var_dump($permiso);
            
            if($this->fila())
                return true;

            return false;
        }//Fin del metodo para consultar una accion
    }//Fin de la clase