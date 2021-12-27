<?php
    namespace App\Models;

    use Core\Model;

    class ProductosModel extends Model
    {
        protected $nombreTabla = 'productos';
        protected $pk_tabla = 'id_producto';

        protected $vistaTabla = 'productos_view';

        protected $camposTabla = [
            'id_unidad',
            'unidad_empaque',
            'id_empresa',
            'id_categoria',
            'codigo_cabys',
            'codigo_venta',
            'codigo_interno',
            'descripcion',
            'impuesto',
            'porcentaje_descuento',
            'descuento',
            'valor_unitario',
            'valor_impuesto',
            'valor_total',
            'fecha_creacion',
            'fecha_modificacion',
            'fecha_eliminacion',
            'estado'
        ];

        protected $camposVista = [
            'simbolo_unidad',
            'nombre_unidad',
            'nombre_categoria',
        ];

        protected $dbGroup = 'facturacion';

        protected $autoIncrement = true;

        protected $auditorias = true;
    }
