<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class DocumentoOtrosModel extends Model
{
	protected $nombreTabla = 'documentos_otros';
	protected $pk_tabla = 'id_documento_otro';

	protected $camposTabla = [
		'id_documento',
        'codigo',
        'valor',
        'fecha_creacion',
	];

    protected $autoIncrement = true;

    

    protected $auditorias = true;

    public function getDocumentoReferencias($id_documento)
    {
        $this->where('id_documento', $id_documento);
        return $this->getAll();
    }
}//Fin de la clase
?>