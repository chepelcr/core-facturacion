<?php
    namespace App\Models;

    use Core\Model;

    class ProductosModel extends Model
    {
        protected $nombreTabla = 'productos';
        protected $pk_tabla = 'id_producto';

        protected $camposTabla = [
            'id_unidad',
            'codigo_cabys',
            'codigo_venta',
            'tipo_producto',
            'descripcion',
            'impuesto',
            'valor unitario',
            'id_empresa',
            'fecha_creacion',
            'fecha_actualizacion',
            'fecha_eliminacion',
            'estado'
        ];

        protected $autoIncrement = true;

        protected $auditorias = true;
    }
