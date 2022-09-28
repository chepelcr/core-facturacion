<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class ReportesModel extends Model
{
	protected $nombreTabla = 'reporte_diario';

	protected $camposTabla = [
		'fecha_documento',
        'codigo',
        'codigo_venta',
        'unidades',
        'unidad_medida',
        'detalle',
        'precio_unidad',
        'valor_neto',
        'valor_subtotal',
        'valor_impuestos',
        'valor_total'
	];    

    protected $autoIncrement = true;

    protected $dbGroup = 'facturacion';

    protected $auditorias = true;

    /**Obtener todos los detalles de un documento */
    public function obtener($id_documento)
    {
        $this->where('id_documento', $id_documento);

        $detalles = $this->getAll();

        foreach ($detalles as $detalle) {
            //Obtener las lineas de descuento del detalle
            $detalle->descuentos = $this->obtenerDescuentos($detalle->id_detalle);

            //Obtener los impuestos del detalle
            $detalle->impuestos = $this->obtenerImpuestos($detalle->id_detalle);
        }//Fin del ciclo

        return $detalles;
    }//Fin del método obtener los detalles de un documento

    /**Obtener todos los descuentos de una linea de detalle */
    public function obtenerDescuentos($id_detalle)
    {
        $descuentosModel = model('documentoDescuentos');
        $descuentos = $descuentosModel->obtener($id_detalle);

        return $descuentos;
    }//Fin de la funcion para obtener los detalles de un documento

    /**Obtener los impuestos de una linea de detalle */
    public function obtenerImpuestos($id_detalle)
    {
        $impuestosModel = model('documentoImpuestos');
        $impuestos = $impuestosModel->obtener($id_detalle);

        return $impuestos;
    }//Fin de la funcion para obtener los impuestos de una linea de detalle
}//Fin de la clase
?>