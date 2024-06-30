<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Librerias\Hacienda;
use App\Librerias\Myqr;
use App\Librerias\Pdf_Manager;
use App\Librerias\Reportes;
use App\Models\ClientesModel;
use App\Models\ConsecutivosModel;
use App\Models\DocumentoModel;
use App\Models\EmpresasModel;
use App\Models\ProductosModel;
use App\Models\TipoCambioModel;
use Core\Config\Header;
use DOMDocument;

class Documentos extends BaseController
{
    public function index()
    {
        if (is_login()) {
            $script = '<script>
                $(document).ready(function(){
                    cargar_inicio_modulo("documentos");
                });
            </script>';

            $data = array(
                'script' => $script,
            );

            return $this->inicio($data);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl('login'));
    } //Fin de la funcion index

    public function facturacion()
    {
        if (is_login()) {
            $script = '<script>
                $(document).ready(function(){
                    cargar_inicio_modulo("documentos");

                    agregar_documento("tiquete");
                });
            </script>';

            $data = array(
                'script' => $script,
            );

            return $this->inicio($data);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl('login'));
    } //Fin de la funcion facturacion

    public function validar_documentos()
    {
        if (!is_login()) {
            return json_encode(array(
                'error' => 'Se ha cerrado la sesión',
                'status' => 'error'
            ));
        } //Fin de la validacion de login

        $hacienda = new Hacienda();

        $documentoModel = model('documento');
        $documentos = $documentoModel->obtener('proceso');

        $validados = true;

        foreach ($documentos as $documento) {
            $validar = json_decode($hacienda->validar($documento->clave), true);

            if (isset($validar['xml']['ind-estado'])) {
                $fecha_gmt = date('Y-m-d\TH:i:s', strtotime('-6 hours'));

                if ($validar['xml']['ind-estado'] != "procesando") {
                    $json = json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))), true);

                    $data_validado = array(
                        'valido_atv' => $json['Mensaje'],
                        'detalle_atv' => $json['DetalleMensaje'],
                        'fecha_valido' => $fecha_gmt,
                    );

                    $documentosModel = model('documento');
                    $documentosModel->update($data_validado, $documento->id_documento);

                    $hacienda->enviar_documento($documento->id_documento);

                    $validados = true;
                }

                if ($validar['xml']['ind-estado'] == "procesando") {
                    $validados = false;
                }
            } else
                $validados = false;
        } //Fin del ciclo de documentos

        if ($validados) {
            $data = array(
                'status' => 'success',
            );
        } else {
            $data = array(
                'status' => 'error',
            );
        }

        return json_encode($data);
    }//Fin de la funcion validar_documentos

    /**Obtener los indicadores de compra y venta desde el banco central */
    public function indicadores()
    {
        if(getSegment(3) == 'CRC')
            return json_encode(obtenerInidicadores());

        else
        {
            return json_encode(obtenerInidicadores('USD'));
        }
    }//Fin de la funcion indicadores

    /**Enviar un documento al ministerio de hacienda */
    public function enviar_hacienda()
    {
        if(!is_login())
        {
            return json_encode(array(
                'status' => 'error',
                'error' => 'login'
            ));
        }

        $documentoModel = model('documento');
        $documento = $documentoModel->obtener(getSegment(3));

        if($documento)
        {
            $hacienda = new Hacienda();

	    $enviar = json_decode($hacienda->enviar($documento->clave));

//	    var_dump($enviar->respuesta);

                if ($enviar->status >= 200 && $enviar->status < 300) {
                    //Obtener la fecha en gmt-6
                    $fecha_gmt = date('Y-m-d\TH:i:s', strtotime('-6 hours'));

                    $data_envio = array(
                        'envio_atv' => 1,
                        'fecha_envio' => $fecha_gmt,
                    );

                    $documentosModel = model('documento');
                    $documentosModel->update($data_envio, $documento->id_documento);

                    sleep(4);

                    $validar = json_decode($hacienda->validar(), true);

                    if (isset($validar['xml']['ind-estado'])) {
                        if ($validar['xml']['ind-estado'] != "procesando") {
                            $json = json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))));

                            $data_validado = array(
                                'valido_atv' => $json->Mensaje,
                                'fecha_valido' => $fecha_gmt,
                                'detalle_atv' => $json->DetalleMensaje,
                            );

                            $documentosModel = model('documento');
                            $documentosModel->update($data_validado, $documento->id_documento);

                            $correo_enviado = $hacienda->enviar_documento($documento->id_documento);

                            return json_encode(array(
                                'clave' => $documento->id_documento,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => $json->Mensaje,
                                "validar_mensaje" => $json->DetalleMensaje,
                                "correo_enviado" => $correo_enviado,
                                'estado' => 'success',
                            ));
                        } else {
                            return json_encode(array(
                                'clave' => $documento->id_documento,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => "Procesando",
                                "validar_mensaje" => "El documento se encuentra en proceso de validación",
                                "correo_enviado" => false,
                                'estado' => 'warning',
                            ));
                        }
                    } else {
                        return json_encode(array(
                            'clave' => $documento->id_documento,
                            "enviar" => $enviar->status,
                            "validar_estado" => 'procesando',
                            "mensaje" => "Procesando",
                            "validar_mensaje" => 'El documento se encuentra en proceso de validación',
                            "correo_enviado" => false,
                            'estado' => 'error',
                        ));
                    }
                } else {
                    return json_encode(array(
                        'clave' => $documento->id_documento,
                        "enviar" => $enviar->status,
                        "validar_estado" => "",
                        "mensaje" => "Error",
                        "error" => 'Se ha generado un error al enviar la factura al Ministerio de Hacienda',
                        "correo_enviado" => false,
                        'estado' => 'error',
                    ));
                }
        }

    }//Fin de la function para enviar un documento al ministerio de hacienda


    /**Enviar un documento electronico */
    public function enviar_documento()
    {
        if(is_login())
        {
            $data = array(
                'status' => 'error',
                'error' => 'No se pudo enviar el documento',
            );

            if(getSegment(3))
            {
                $id_documento = getSegment(3);

                $hacienda = new Hacienda();

                if($hacienda->enviar_documento($id_documento))
                {
                    $data = array(
                        'status' => 'success',
                        'mensaje' => 'Documento enviado correctamente',
                    );
                }
            }

            return json_encode($data);
        }

        return redirect(baseUrl());
        
    }

    /**Cargar los documentos de la empresa */
    public function cargar_documentos()
    {
        if (is_login()) {
            $model = new DocumentoModel();
            $model->empresa(getSession('id_empresa'));

            $id_tipo_documento = post('id_tipo_documento');

            $fecha_inicio = null;
            $fecha_fin = null;

            $model->tipo_documento($id_tipo_documento);

            if (getSegment(3)) {
                $tipo_reporte = getSegment(3);

                if ($tipo_reporte == 'busqueda') {
                    $documentos = $model->busqueda(post('fecha_inicio'), post('fecha_fin'));
                    $tipo_reporte = post('tipo_reporte');
                } else {
                    $documentos = $model->obtener($tipo_reporte);
                }
            } else {
                $tipo_reporte = 'diarios';
                $documentos = $model->obtener($tipo_reporte);
            }

            $model = model('tiposDocumentos');

            $dataView = array(
                'documentos' => $documentos,
                'tipo_reporte' => $tipo_reporte,
                'tipos_documentos' => $model->getAll(),
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'id_tipo_documento' => $id_tipo_documento,
            );

            //var_dump($model->getAll());

            return view('facturacion/table/documentos', $dataView);
        } else {
            $error = $this->object_error(505, 'No ha iniciado sesión');
            return $this->error($error);
        }
    }

    public function validar_documento()
    {
        if (is_login()) {
            if (getSegment(3)) {
                $id_documento = getSegment(3);

                $model = model('documento');

                $documento = $model->obtener($id_documento);

                if ($documento) {
                    $hacienda = new Hacienda();
                    $validar = json_decode($hacienda->validar($documento->clave), true);

                    if (isset($validar['xml']['ind-estado'])) {
                        $fecha_gmt = date('Y-m-d\TH:i:s', strtotime('-6 hours'));

                        if ($validar['xml']['ind-estado'] != "procesando") {
                            $json = json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))), true);

                            $data_validado = array(
                                'valido_atv' => $json['Mensaje'],
                                'detalle_atv' => $json['DetalleMensaje'],
                                'fecha_valido' => $fecha_gmt,
			    );

                            $documentosModel = model('documento');
                            $documentosModel->update($data_validado, $id_documento);
                            
                            $correo_enviado = $hacienda->enviar_documento($id_documento);

                            return json_encode(array(
                                'clave' => $id_documento,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => $json['Mensaje'],
                                "validar_mensaje" => $json['DetalleMensaje'],
                                'estado' => 'success',
                                'correo_enviado' => $correo_enviado,
                            ));
                        } else {
                            return json_encode(array(
                                'clave' => $id_documento,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => "2",
                                "validar_mensaje" => "Procesando documento",
                                'estado' => 'warning',
                                'correo_enviado' => false,
                            ));
                        }
                    } else {
                        return json_encode(array(
                            'clave' => $id_documento,
                            "validar_estado" => 'procesando',
                            "mensaje" => "2",
                            "validar_mensaje" => "Procesando documento",
                            'estado' => 'warning',
                            'correo_enviado' => false,
                        ));
                    }
                }
            }

            return json_encode(array(
                'error' => 'El documento solicitado no existe',
                'estado' => 'warning',
            ));
        }

        return json_encode(array(
            'error' => 'No ha iniciado sesion',
            'estado' => 'info',
        ));
    }

    /**Obtener todos los productos */
    public function get_productos()
    {
        if (is_login()) {
            $model = model('productos');

            $model->where('id_empresa', getSession('id_empresa'));

            $productos = $model->obtener('activos');

            $dataView = array(
                'productos' => $productos,
            );

            return view('facturacion/table/productos', $dataView);
        }

        $error = $this->object_error(505, 'No ha iniciado sesión');
        return $this->error($error);
    } //Fin de la funcion get_productos

    /**Obtener todos los clientes */
    public function get_clientes()
    {
        if (is_login()) {
            $model = model('clientes');

            $model->where('id_empresa', getSession('id_empresa'));

            $clientes = $model->obtener('activos');

            $dataView = array(
                'clientes' => $clientes,
            );

            return view('facturacion/table/clientes', $dataView);
        }

        $error = $this->object_error(505, 'No ha iniciado sesión');
        return $this->error($error);
    } //Fin de la funcion get_clientes

    /**Emitir un tiquete electronico */
    public function tiquete()
    {
        if (is_login()) {
            $id_tipo_documento = '04';

            $numero_documento = getSegment(3);

            return documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para emitir un tiquete electronico

    /**Emitir una factura electronica */
    public function factura()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '01';

            return documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para emitir una factura electronica

    /**Emitir una nota de credito (03) */
    public function nota_credito()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '03';

            return documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para emitir una nota de credito

    /**Emitir una nota de debito (02) */
    public function nota_debito()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '02';

            return documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para emitir una nota de debito

    /**Obtener un boton para el nuevo documento */
    public function get_boton()
    {
        if (is_login()) {
            $numero_documento = getSegment(3);

            $boton = view('facturacion/elementos/boton', array('numero_documento' => $numero_documento));

            return $boton;
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion get_boton

    /**Buscar un cliente por identificacion */
    public function buscar_cliente()
    {
        if (is_login()) {
            if (getSegment(3)) {
                $identificacion = getSegment(3);

                $clientesModel = new ClientesModel();
                $cliente = $clientesModel->getByIdentificacion($identificacion);

                if ($cliente)
                    return json_encode($cliente);

                else
                    $data = array(
                        'error' => 'No se encontro el cliente',
                    );
            } else
                $data = array(
                    'error' => 'No se encontro el cliente',
                );
        } //Fin de la validacion

        else
            $data = array(
                'error' => 'No ha iniciado sesión'
            );

        return json_encode($data);
    } //Fin de la funcion buscar_cliente

    /**Obtener un documento en pdf */
    public function ver_pdf()
    {
        if (is_login()) {
            $clave = getSegment(3);

            $dataView = array(
                'clave' => $clave
            );

            $nombreVista = 'facturacion/modal/ver_pdf';

            return view($nombreVista, $dataView);
        } else
            header('Location: ' . baseUrl());
    }

    /**Guardar un  documento electronico*/
    public function guardar($objeto = null)
    {
        if (is_login()) {
            $id_cliente = post('identificacion-cliente');

            $id_tipo_documento = post('id_tipo_documento');

            $moneda = post('moneda');
            $tipo_cambio = post('tipo_cambio');

            //var_dump($tipo_cambio);

	    if(!$tipo_cambio){
                $tipoCambioModel = new TipoCambioModel();
		$tipo_cambio = $tipoCambioModel->obtener($moneda);

		$tipo_cambio = $tipo_cambio->tipo_cambio;
	    }

            //Efectivo
            $efectivo = post('efectivo');

            //Tarjeta
            $tarjeta = post('tarjeta');

            //Transferencia
            $transferencia = post('transferencia');

            //Otros
            $otros = post('otros');

            //Validar medio de pago
            if (!$efectivo && !$tarjeta && !$transferencia && !$otros)
                return json_encode(array(
                    'error' => 'Debe seleccionar al menos un medio de pago',
                    'estado' => 'error'
                ));

            else {
                if ($efectivo)
                    $medio_pago = $efectivo;
                else
                    if ($tarjeta)
                    $medio_pago = $tarjeta;
                else
                        if ($transferencia)
                    $medio_pago = $transferencia;
                else
                    $medio_pago = $otros;
            }

            $condicion_venta = post('condicion_venta');
            $dias = 0;

            if ($condicion_venta == "02") {
                $dias = 30;
            }

            $consecutivosModel = new ConsecutivosModel();
            $consecutivo = $consecutivosModel->obtener_consecutivo($id_tipo_documento, getEnt('factura.ambiente'));

            $consecutivosModel = new ConsecutivosModel();
            $consecutivosModel->actualizar_consecutivo($consecutivo->id_consecutivo, $consecutivo->consecutivo + 1);

            $id_factura = $consecutivo->consecutivo;
            $factura = str_pad($id_factura, 10, "0", STR_PAD_LEFT);
            
            $sucursal = getent('factura.sucursal');
            $pv = getent('factura.punto_venta');

            //Rellenar con ceros 000 la sucursal
            $sucursal = str_pad($sucursal, 3, "0", STR_PAD_LEFT);

            //Rellenar con ceros 00000 el punto de venta
            $pv = str_pad($pv, 5, "0", STR_PAD_LEFT);

            $tipoDocumento = $id_tipo_documento;

            $consecutivo = $sucursal . $pv . $tipoDocumento . $factura;

            $notas = post('notas');

            $empresasModel = new EmpresasModel();
            $emisor = $empresasModel->getById(getSession('id_empresa'));

            $cod = $emisor->codigo_telefono;
            $ced = $emisor->identificacion;
            $cedulaEmisor = str_pad($ced, 12, "0", STR_PAD_LEFT);
            $situacion = "1";

            $codigoSeguridad = substr(str_shuffle("0123456789"), 0, 8);

            $clave = $cod . date('d') . date('m') . date('y') . $cedulaEmisor . $consecutivo . $situacion . $codigoSeguridad;

            if ($id_tipo_documento != '04') {
                $clientesModel = new ClientesModel();
                $receptor = $clientesModel->getByIdentificacion($id_cliente);
            }

            //Validar el tipo de documento
            switch ($id_tipo_documento) {
                    /**Factura electronica */
                case '01':
                    //Validar si el cliente existe en la tabla de clientes
                    if (!$receptor) {
                        return json_encode(array(
                            'error' => 'Debe indicar un cliente valido',
                            'tipo' => 'receptor',
                            'estado' => 'error'
                        ));
                    }

                    /**Validar si el cliente de la factura es walmart */
                    if ($receptor->nombre_comercial == 'Walmart') {
                        if (!post('numero_vendor') || !post('numero_orden') || !post('enviar_gnl')) {
                            return json_encode(array(
                                'error' => 'Faltan datos para enviar a Walmart',
                                'tipo' => 'walmart',
                                'estado' => 'error'
                            ));
                        }

                        //Si el numero de orden no tiene 10 caracteres
                        if (strlen(post('numero_orden')) != 10)
                            return json_encode(array(
                                'error' => 'El numero de orden debe tener 10 caracteres',
                                'campo' => 'numero_orden',
                                'estado' => 'error'
                            ));

                        //Rellenar con 0 hasta 9 numero_vendor
                        $numero_vendor = str_pad(post('numero_vendor'), 9, "0", STR_PAD_LEFT);
                    } //Fin de la validacion de walmart

                    $stringXML = '<?xml version="1.0" encoding="utf-8"?>
                <FacturaElectronica 
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                    xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica">';
                    break;

                    /**Nota de debito electronica */
                case '02':
                    $cantidad_referencias = 0;

                    if (isset($_POST['referencia_clave'])) {
                        foreach ($_POST['referencia_clave'] as $key => $value) {
                            if ($_POST['referencia_clave'][$key] != '') {
                                $cantidad_referencias++;
                            }
                        }
                    }

                    if ($cantidad_referencias == 0) {
                        return json_encode(array(
                            'error' => 'Debe ingresar al menos una referencia',
                            'estado' => 'error'
                        ));
                    }

                    $stringXML = '<?xml version="1.0" encoding="utf-8"?>
                <NotaDebitoElectronica
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                    xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaDebitoElectronica">';
                    break;

                    /**Nota de credito electronica */
                case '03':
                    $cantidad_referencias = 0;

                    //var_dump(post());

                    if (isset($_POST['referencia_clave'])) {
                        foreach ($_POST['referencia_clave'] as $key => $value) {
                            if ($_POST['referencia_clave'][$key] != '') {
                                $cantidad_referencias++;
                            }
                        }
                    }

                    if ($cantidad_referencias == 0) {
                        return json_encode(array(
                            'error' => 'Debe ingresar al menos una referencia',
                            'estado' => 'error'
                        ));
                    }

                    $stringXML = '<?xml version="1.0" encoding="utf-8"?>
                <NotaCreditoElectronica
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                    xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/notaCreditoElectronica">';
                    break;

                    /**Tiquete electronico */
                case '04':
                    $stringXML = '<?xml version="1.0" encoding="utf-8"?>
                <TiqueteElectronico
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                    xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/tiqueteElectronico">';

                    break;

                default:
                    return json_encode(array(
                        'error' => 'Implementando documento',
                        'estado' => 'error'
                    ));
            }

            $stringXML .= '<Clave>' . $clave . '</Clave>
            <CodigoActividad>' . $emisor->cod_actividad . '</CodigoActividad>
            <NumeroConsecutivo>' . $consecutivo . '</NumeroConsecutivo>
            <FechaEmision>' . date("c") . '</FechaEmision>
            <Emisor>
                <Nombre>' . $emisor->razon . '</Nombre>
                <Identificacion>
                    <Tipo>' . $emisor->id_tipo_identificacion . '</Tipo>
                    <Numero>' . $emisor->identificacion . '</Numero>
                </Identificacion>
                <NombreComercial>' . $emisor->nombre_comercial . '</NombreComercial>
                <Ubicacion>
                    <Provincia>' . $emisor->cod_provincia . '</Provincia>
                    <Canton>' . str_pad($emisor->cod_canton, 2, "0", STR_PAD_LEFT) . '</Canton>
                    <Distrito>' . str_pad($emisor->cod_distrito, 2, "0", STR_PAD_LEFT) . '</Distrito>
                    <Barrio>' . str_pad($emisor->cod_barrio, 2, "0", STR_PAD_LEFT) . '</Barrio>
                    <OtrasSenas>' . $emisor->otras_senas . '</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>' . $emisor->codigo_telefono . '</CodigoPais>
                    <NumTelefono>' . $emisor->telefono . '</NumTelefono>
                </Telefono>
                <CorreoElectronico>' . $emisor->correo . '</CorreoElectronico>
            </Emisor>';

            /**Si el documento no es un tiquete electronico, no agregar la informacion del cliente al archivo XML */
            if ($id_tipo_documento != '04' && $receptor) {

                $stringXML .= '<Receptor>
                <Nombre>' . $receptor->razon . '</Nombre>
                <Identificacion>
                    <Tipo>' . $receptor->id_tipo_identificacion . '</Tipo>
                    <Numero>' . $receptor->identificacion . '</Numero>
                </Identificacion>
                <NombreComercial>' . $receptor->nombre_comercial . '</NombreComercial>
                <Ubicacion>
                    <Provincia>' . $receptor->cod_provincia . '</Provincia>
                    <Canton>' . str_pad($receptor->cod_canton, 2, "0", STR_PAD_LEFT) . '</Canton>
                    <Distrito>' . str_pad($receptor->cod_distrito, 2, "0", STR_PAD_LEFT) . '</Distrito>
                    <Barrio>' . str_pad($receptor->cod_barrio, 2, "0", STR_PAD_LEFT) . '</Barrio>
                    <OtrasSenas>' . $receptor->otras_senas . '</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>' . $receptor->codigo_telefono . '</CodigoPais>
                    <NumTelefono>' . $receptor->telefono . '</NumTelefono>
                </Telefono>
                <CorreoElectronico>' . $receptor->correo . '</CorreoElectronico>
            </Receptor>';
            }

            $stringXML .= '<CondicionVenta>' . $condicion_venta . '</CondicionVenta>
            <PlazoCredito>' . $dias . '</PlazoCredito>
            <MedioPago>' . $medio_pago . '</MedioPago>
            <DetalleServicio>';

            $totalServGravados = 0;
            $totalServExentos = 0;
            $totalServExonerado = 0;
            $totalMercanciasGravadas = 0;
            $totalMercanciasExentas = 0;
            $totalMercExonerada = 0;
            $totalGravado = 0;
            $totalExento = 0;
            $totalExonerado = 0;
            $totalVenta = 0;
            $totalDescuentos = 0;
            $totalVentaNeta = 0;
            $totalImpuesto = 0;
            $totalComprobante = 0;

            $lineas = 0;

            foreach ($_POST['codigo'] as $key => $linea) {

                $codigo = $_POST['codigo'][$key];

                if ($codigo != "") {
                    $stringXML .= '<LineaDetalle>
                        <NumeroLinea>' . ($key + 1) . '</NumeroLinea>
                        <Codigo>' . $_POST['codigo'][$key] . '</Codigo>
                        <Cantidad>' . $_POST['cantidad'][$key] . '</Cantidad>
                        <UnidadMedida>' . $_POST['unidad'][$key] . '</UnidadMedida>
                        <Detalle>' . $_POST['detalle'][$key] . '</Detalle>
                        <PrecioUnitario>' . $_POST['precio_unidad'][$key] . '</PrecioUnitario>
                        <MontoTotal>' . $_POST['monto_total'][$key] . '</MontoTotal>';

                    //var_dump($stringXML);

                    //break;

                    if ($_POST['monto_descuento'][$key] > 0) {
                        $motivo = $_POST['motivo_descuento'][$key];

                        if ($motivo == "") {
                            $motivo = "Descuento de sistema";
                        }

                        $stringXML .= '<Descuento>
                                <MontoDescuento>' . $_POST['monto_descuento'][$key] . '</MontoDescuento>
                                <NaturalezaDescuento>' . $_POST['motivo_descuento'][$key] . '</NaturalezaDescuento>
                            </Descuento>';
                    }

                    $stringXML .= '<SubTotal>' . $_POST['sub_total'][$key] . '</SubTotal>
                        <Impuesto>
                            <Codigo>01</Codigo>
                            <CodigoTarifa>08</CodigoTarifa>
                            <Tarifa>' . $_POST['tarifa'][$key] . '</Tarifa>
                            <Monto>' . $_POST['monto_impuesto'][$key] . '</Monto>  
                        </Impuesto>
                        
                        <ImpuestoNeto>' . $_POST['monto_impuesto'][$key] . '</ImpuestoNeto>
                        <MontoTotalLinea>' . $_POST['total_linea'][$key] . '</MontoTotalLinea>
                    </LineaDetalle>';

                    //Calcular los totales con dos decimales

                    //acumular
                    if ($_POST['unidad'][$key] == "Sp" || $_POST['unidad'][$key] == "Spe" || $_POST['unidad'][$key] == "Cm") {
                        //todos los servicios son gravados
                        $totalServGravados += $_POST['monto_total'][$key];
                    } else {
                        //todas las mercancias son gravados
                        $totalMercanciasGravadas += $_POST['monto_total'][$key];
                    }

                    //todas las mercancias y servicios son gravados y con dos decimales
                    $totalGravado += $_POST['monto_total'][$key];
                    $totalVenta += $_POST['monto_total'][$key];
                    $totalDescuentos += $_POST['monto_descuento'][$key];
                    $totalVentaNeta += $_POST['sub_total'][$key];
                    $totalImpuesto += $_POST['monto_impuesto'][$key];
                    $totalComprobante += $_POST['total_linea'][$key];

                    $lineas++;
                }
            }

            if ($lineas == 0) {
                return json_encode(array(
                    "error" => "No se puede emitir un comprobante sin detalle",
                    'tipo' => 'detalles',
                    "estado" => "error"
                ));
            }

            /**Si el documento no es un tiquete electronico, agregar informacion del cliente */
            if ($id_tipo_documento != '04' && $receptor) {
                $data_factura = array(
                    "consecutivo" => $consecutivo,
                    "tipo_documento" => $id_tipo_documento,
                    "clave" => $clave,
                    "codigo_seguridad" => $codigoSeguridad,
                    "emisor_cedula" => $emisor->identificacion,
                    "emisor_nombre" => $emisor->razon,
                    "emisor_tipo" => $emisor->id_tipo_identificacion,
                    "emisor_comercial" => $emisor->nombre_comercial,
                    "emisor_id_provincia" => $emisor->cod_provincia,
                    "emisor_id_canton" => $emisor->cod_canton,
                    "emisor_id_distrito" => $emisor->cod_distrito,
                    "emisor_id_barrio" => $emisor->cod_barrio,
                    "emisor_otras_senas" => $emisor->otras_senas,
                    "emisor_cod" => $emisor->codigo_telefono,
                    "emisor_telefono" => $emisor->telefono,
                    "emisor_correo" => $emisor->correo,
                    "receptor_nombre" => $receptor->nombre_comercial,
                    "receptor_cedula" => $receptor->identificacion,
                    "receptor_tipo" => $receptor->id_tipo_identificacion,
                    "receptor_comercial" => $receptor->nombre_comercial,
                    "receptor_id_provincia" => $receptor->cod_provincia,
                    "receptor_id_canton" => $receptor->cod_canton,
                    "receptor_id_distrito" => $receptor->cod_distrito,
                    "receptor_id_barrio" => $receptor->cod_barrio,
                    "receptor_otras_senas" => $receptor->otras_senas,
                    "receptor_cod" => $receptor->codigo_telefono,
                    "receptor_telefono" => $receptor->telefono,
                    "receptor_correo" => $receptor->correo,
                    "condicion_venta" => $condicion_venta,
                    "plazo_credito" => $dias,
                    "medio_pago" => $medio_pago,
                    "moneda" => $moneda,
                    "tipo_cambio" => $tipo_cambio,
                    "servicios_gravados" => $totalServGravados,
                    "servicios_exentos" => $totalServExentos,
                    "servicios_exonerados" => $totalServExonerado,
                    "mercancias_gravadas" => $totalMercanciasGravadas,
                    "mercancias_exentas" => $totalMercanciasExentas,
                    "mercancias_exoneradas" => $totalMercExonerada,
                    "total_gravado" => $totalGravado,
                    "total_exento" => $totalExento,
                    "total_exonerado" => $totalExonerado,
                    "total_venta" => $totalVenta,
                    "total_descuentos" => $totalDescuentos,
                    "total_venta_neta" => $totalVentaNeta,
                    "total_impuestos" => $totalImpuesto,
                    "total_comprobante" => $totalComprobante,
                    "notas" => $notas,
                    "envio_atv" => 0,
                    "valido_atv" => 0,
                    "id_usuario" => getSession('id_usuario'),
                    "id_empresa" => getSession('id_empresa'),
                );
            } else {
                $data_factura = array(
                    "consecutivo" => $consecutivo,
                    "tipo_documento" => $id_tipo_documento,
                    "clave" => $clave,
                    "codigo_seguridad" => $codigoSeguridad,
                    "emisor_cedula" => $emisor->identificacion,
                    "emisor_nombre" => $emisor->razon,
                    "emisor_tipo" => $emisor->id_tipo_identificacion,
                    "emisor_comercial" => $emisor->nombre_comercial,
                    "emisor_id_provincia" => $emisor->cod_provincia,
                    "emisor_id_canton" => $emisor->cod_canton,
                    "emisor_id_distrito" => $emisor->cod_distrito,
                    "emisor_id_barrio" => $emisor->cod_barrio,
                    "emisor_otras_senas" => $emisor->otras_senas,
                    "emisor_cod" => $emisor->codigo_telefono,
                    "emisor_telefono" => $emisor->telefono,
                    "emisor_correo" => $emisor->correo,
                    "condicion_venta" => $condicion_venta,
                    "plazo_credito" => $dias,
                    "medio_pago" => $medio_pago,
                    "moneda" => $moneda,
                    "tipo_cambio" => $tipo_cambio,
                    "servicios_gravados" => $totalServGravados,
                    "servicios_exentos" => $totalServExentos,
                    "servicios_exonerados" => $totalServExonerado,
                    "mercancias_gravadas" => $totalMercanciasGravadas,
                    "mercancias_exentas" => $totalMercanciasExentas,
                    "mercancias_exoneradas" => $totalMercExonerada,
                    "total_gravado" => $totalGravado,
                    "total_exento" => $totalExento,
                    "total_exonerado" => $totalExonerado,
                    "total_venta" => $totalVenta,
                    "total_descuentos" => $totalDescuentos,
                    "total_venta_neta" => $totalVentaNeta,
                    "total_impuestos" => $totalImpuesto,
                    "total_comprobante" => $totalComprobante,
                    "notas" => $notas,
                    "envio_atv" => 0,
                    "valido_atv" => 0,
                    "id_usuario" => getSession('id_usuario'),
                    "id_empresa" => getSession('id_empresa'),
                );
            }

            //var_dump($data_factura);

            $documentosModel = model('documento');

            $id_documento = $documentosModel->insert($data_factura);

            if ($id_documento) {
                foreach ($_POST['codigo'] as $key => $linea) {
                    //insertar cada detalle
                    $documentosDetallesModel = model('documentoDetalles');

                    $codigo = $_POST['codigo'][$key];
                    $nombre = $_POST['detalle'][$key];

                    if ($codigo != '') {
                        $data_detalle = array(
                            "id_documento"  => $id_documento,
                            "linea"   => $key + 1,
                            "codigo"  => $codigo,
                            "cantidad"    => $_POST['cantidad'][$key],
                            "unidad_medida"   => $_POST['unidad'][$key],
                            "detalle" => $nombre,
                            "precio_unidad"  => $_POST['precio_unidad'][$key],
                            "monto_total" => $_POST['monto_total'][$key],
                            "monto_descuento" => $_POST['monto_descuento'][$key],
                            "motivo_descuento"   => $_POST['motivo_descuento'][$key],
                            "sub_total" => $_POST['sub_total'][$key],
                            "codigo_impuesto" => "01",
                            "codigo_tarifa"  => "08",
                            "tarifa"  => $_POST['tarifa'][$key],
                            "monto_impuesto"  => $_POST['monto_impuesto'][$key],
                            "impuesto_neto"   => $_POST['monto_impuesto'][$key],
                            "total_linea" => $_POST['total_linea'][$key],
                        );

                        $documentosDetallesModel->insert($data_detalle);
                    }
                } //Fin del ciclo para insertar los detalles


                $stringXML .= '</DetalleServicio>
                    <ResumenFactura>
                        <CodigoTipoMoneda>
                            <CodigoMoneda>' . $moneda . '</CodigoMoneda>';

                if ($moneda != 'CRC') {
                    $stringXML .= '<TipoCambio>' . $tipo_cambio . '</TipoCambio>';
                } else {
                    $stringXML .= '<TipoCambio>1</TipoCambio>';
                }

                $stringXML .= '</CodigoTipoMoneda>
                        <TotalServGravados>' . $totalServGravados . '</TotalServGravados>
                        <TotalServExentos>' . $totalServExentos . '</TotalServExentos>
                        <TotalServExonerado>' . $totalServExonerado . '</TotalServExonerado>
                        <TotalMercanciasGravadas>' . $totalMercanciasGravadas . '</TotalMercanciasGravadas>
                        <TotalMercanciasExentas>' . $totalMercanciasExentas . '</TotalMercanciasExentas>
                        <TotalMercExonerada>' . $totalMercExonerada . '</TotalMercExonerada>
                        <TotalGravado>' . $totalGravado . '</TotalGravado>
                        <TotalExento>' . $totalExento . '</TotalExento>
                        <TotalExonerado>' . $totalExonerado . '</TotalExonerado>
                        <TotalVenta>' . $totalVenta . '</TotalVenta>
                        <TotalDescuentos>' . $totalDescuentos . '</TotalDescuentos>
                        <TotalVentaNeta>' . $totalVentaNeta . '</TotalVentaNeta>
                        <TotalImpuesto>' . $totalImpuesto . '</TotalImpuesto>
                        <TotalComprobante>' . $totalComprobante . '</TotalComprobante>
                    </ResumenFactura>';

                //Validar el tipo de documento
                switch ($id_tipo_documento) {
                    case '01':
                        if ($receptor->nombre_comercial == 'Walmart') {
                            $stringXML .= '<Otros>
                                <OtroTexto codigo="WMNumeroVendedor">' . $numero_vendor . '</OtroTexto>
                                <OtroTexto codigo="WMNumeroOrden">' . post('numero_orden') . '</OtroTexto>
                                <OtroTexto codigo="WMEnviarGLN">' . post('enviar_gnl') . '</OtroTexto>
                            </Otros>';

                            $data_otros = array(
                                array(
                                    "id_documento" => $id_documento,
                                    "codigo" => "WMNumeroVendedor",
                                    "valor" => $numero_vendor
                                ),
                                array(
                                    "id_documento" => $id_documento,
                                    "codigo" => "WMNumeroOrden",
                                    "valor" => post('numero_orden')
                                ),
                                array(
                                    "id_documento" => $id_documento,
                                    "codigo" => "WMEnviarGLN",
                                    "valor" => post('enviar_gnl')
                                )
                            );

                            foreach ($data_otros as $key => $value) {
                                $documentosOtrosModel = model('documentoOtros');
                                $documentosOtrosModel->insert($value);
                            }
                        }
                        $stringXML .= '</FacturaElectronica>';
                        break;

                    case '02':
                        foreach ($_POST['referencia_clave'] as $key => $value) {
                            if ($_POST['referencia_clave'][$key] != '') {
                                $fecha = $_POST['referencia_fecha'][$key];

                                //Si la fecha esta vacia, se asigna la fecha (c) actual
                                if ($fecha == '' || !isset($fecha)) {
                                    $fecha = date('Y-m-d');
                                }

                                $stringXML .= '<InformacionReferencia>
                                    <TipoDoc>' . $_POST['referencia_tipo_documento'][$key] . '</TipoDoc>
                                    <Numero>' . $_POST['referencia_clave'][$key] . '</Numero>
                                    <FechaEmision>' . date("c", strtotime($fecha)) . '</FechaEmision>
                                    <Codigo>' . $_POST['referencia_codigo'][$key] . '</Codigo>
                                    <Razon>' . $_POST['referencia_razon'][$key] . '</Razon>
                                </InformacionReferencia>';

                                $data_referencia = array(
                                    "id_documento"  => $id_documento,
                                    "referencia_tipo_documento"   => $_POST['referencia_tipo_documento'][$key],
                                    "referencia_clave"    => $_POST['referencia_clave'][$key],
                                    "referencia_fecha"   => $_POST['referencia_fecha'][$key],
                                    "referencia_codigo"  => $_POST['referencia_codigo'][$key],
                                    "referencia_razon"    => $_POST['referencia_razon'][$key],
                                );

                                //Insertar el detalle de referencia
                                $documentosReferenciasModel = model('documentoReferencias');
                                $documentosReferenciasModel->insert($data_referencia);
                            }
                        }

                        $stringXML .= '</NotaDebitoElectronica>';
                        break;

                    case '03':
                        foreach ($_POST['referencia_clave'] as $key => $value) {
                            if ($_POST['referencia_clave'][$key] != '') {
                                $fecha = $_POST['referencia_fecha'][$key];

                                $stringXML .= '<InformacionReferencia>
                                    <TipoDoc>' . $_POST['referencia_tipo_documento'][$key] . '</TipoDoc>
                                    <Numero>' . $_POST['referencia_clave'][$key] . '</Numero>
                                    <FechaEmision>' . date("c", strtotime($fecha)) . '</FechaEmision>
                                    <Codigo>' . $_POST['referencia_codigo'][$key] . '</Codigo>
                                    <Razon>' . $_POST['referencia_razon'][$key] . '</Razon>
                                </InformacionReferencia>';

                                //Insertar el detalle de referencia
                                $documentosReferenciasModel = model('documentoReferencias');

                                $data_referencia = array(
                                    "id_documento"  => $id_documento,
                                    "referencia_tipo_documento"   => $_POST['referencia_tipo_documento'][$key],
                                    "referencia_clave"    => $_POST['referencia_clave'][$key],
                                    "referencia_fecha"   => $_POST['referencia_fecha'][$key],
                                    "referencia_codigo"  => $_POST['referencia_codigo'][$key],
                                    "referencia_razon"    => $_POST['referencia_razon'][$key],
                                );

                                $documentosReferenciasModel->insert($data_referencia);
                            }
                        }
                        $stringXML .= '</NotaCreditoElectronica>';
                        break;

                    case '04':
                        $stringXML .= '</TiqueteElectronico>';
                        break;
                }

                $salida = location("archivos\\xml\\p_firmar\\$clave.xml");
                $doc = new DOMDocument();
                $doc->preseveWhiteSpace = false;
                $doc->loadXml($stringXML);
                $doc->save($salida);
                $doc->saveXML();
                
                $hacienda = new Hacienda();

                $xml64 = $hacienda->firmarXml($clave);

                $enviar = json_decode($hacienda->enviarXml($xml64));

                if ($enviar->status >= 200 && $enviar->status < 300) {
                    //Obtener la fecha en gmt-6
                    $fecha_gmt = date('Y-m-d\TH:i:s', strtotime('-6 hours'));
                    $data_envio = array(
                        'envio_atv' => 1,
                        'fecha_envio' => $fecha_gmt,
                    );

                    $documentosModel = model('documento');
                    $documentosModel->update($data_envio, $id_documento);

                    sleep(4);

                    $validar = json_decode($hacienda->validarXml($xml64), true);

                    if (isset($validar['xml']['ind-estado'])) {
                        if ($validar['xml']['ind-estado'] != "procesando") {
                            $json = json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))), true);

                            $data_validado = array(
                                'valido_atv' => $json['Mensaje'],
                                'fecha_valido' => $fecha_gmt,
                                'detalle_atv' => $json['DetalleMensaje'],
                            );

                            $documentosModel = model('documento');
                            $documentosModel->update($data_validado, $id_documento);

                            $correo_enviado = $hacienda->enviar_documento($id_documento);

                            return json_encode(array(
                                'clave' => $id_documento,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => $json['Mensaje'],
                                "validar_mensaje" => $json['DetalleMensaje'],
                                "correo_enviado" => $correo_enviado,
                                'estado' => 'success',
                            ));
                        } else {
                            return json_encode(array(
                                'clave' => $id_documento,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => "Procesando",
                                "validar_mensaje" => "El documento se encuentra en proceso de validación",
                                "correo_enviado" => false,
                                'estado' => 'warning',
                            ));
                        }
                    } else {
                        return json_encode(array(
                            'clave' => $id_documento,
                            "enviar" => $enviar->status,
                            "validar_estado" => 'procesando',
                            "mensaje" => "Procesando",
                            "validar_mensaje" => 'El documento se encuentra en proceso de validación',
                            "correo_enviado" => false,
                            'estado' => 'warning',
                        ));
                    }
                } else {
                    return json_encode(array(
                        'clave' => $id_documento,
                        "enviar" => $enviar->status,
                        "validar_estado" => "",
                        "mensaje" => "Error",
                        "error" => 'Se ha generado un error al enviar la factura al Ministerio de Hacienda',
                        "correo_enviado" => false,
                        'estado' => 'error',
                    ));
                }
            } //Fin de validacion de insercion y envio de correo

            else {
                return json_encode(array(
                    'error' => 'Error al insertar el documento',
                    'estado' => 'error',
                ));
            }
        } //Fin de validacion de logueo

        else
            return json_encode(array(
                'error' => 'No ha iniciado sesion'
            ));
    } //Fin de la funcion create

    /**Obtener el modal de agregar los elementos de Walmart */
    public function get_walmart()
    {
        if (is_login()) {
            return view('facturacion/modal/walmart', getInfoWalmart());
        } else
            return json_encode(array(
                'error' => 'No ha iniciado sesion'
            ));
    } //Fin de la funcion get_walmart

    /**Descargar un documento en pdf */
    public function descargar_pdf()
    {
        if (is_login()) {
            $clave = getSegment(3);

            $pdf = new Pdf_Manager();
            $qr = new Myqr();

            $DocumentosModel = new DocumentoModel();

            $documento = $DocumentosModel->obtener($clave);

            if ($documento) {
                $detalles = $documento->detalles;

                $dataQR = array(
                    'url' => baseUrl("documentos/pdf/" . $clave),
                );

                $qrCodigo = $qr->codigoQR($dataQR);

                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );

                $logoImg = file_get_contents(getFile('dist/img/logo.png'), false, stream_context_create($arrContextOptions));

                $logo = base64_encode($logoImg);

                $nombreArchivo = "DOC_" . $documento->clave . ".pdf";

                $dataPdf = array(
                    'nombre_archivo' => $nombreArchivo,
                    'documento' => $documento,
                    'detalles' => $detalles,
                    "qrCodigo" => $qrCodigo,
                    "logo" => $logo,
                );

                $pdf->download_view("pdfs/facturaPDF", $dataPdf);
            } //Fin de la validacion del documento

            else
                echo "Documento no existe";
        } //Fin de la funcion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para descargar un documento

    /**Descargar un archivo zip */
    public function descargar_zip()
    {
        if (is_login()) {
            if (getSegment(3)) {
                $nombre_archivo = getSegment(3);
                $ruta = location('archivos\\reportes\\' . $nombre_archivo);

                if (file_exists($ruta)) {
                    header('Content-Type: application/Force-Download');
                    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
                    header('Content-Length: ' . filesize($ruta));
                    readfile($ruta);

                    unlink($ruta);

                    exit;
                }
            }
        }

        header('Location: ' . baseUrl());
    } //Fin de la funcion  para descargar un archivo zip

    /** Ver un documento pdf en el navegador */
    public function pdf()
    {
        $clave = getSegment(3);

        $pdf = new Pdf_Manager();
        $qr = new Myqr();

        $DocumentosModel = new DocumentoModel();

        $documento = $DocumentosModel->obtener($clave);

        if ($documento) {
            $detalles = $documento->detalles;

            $dataQR = array(
                'url' => baseUrl("documentos/pdf/" . $clave),
            );

            $qrCodigo = $qr->codigoQR($dataQR);

            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            $logoImg = file_get_contents(location('files/dist/img/logo.png'), false, stream_context_create($arrContextOptions));

            $logo = base64_encode($logoImg);

            $nombreArchivo = "/pdf/Documento " . $documento->clave . ".pdf";

            $dataPdf = array(
                'nombre_archivo' => $nombreArchivo,
                'documento' => $documento,
                'detalles' => $detalles,
                "qrCodigo" => $qrCodigo,
                "logo" => $logo,
            );

            Header::pdf();

            $pdf->load_view("pdfs/facturaPDF", $dataPdf);
        } //Fin de la validacion del documento

        else
            echo "Documento no existe";
    } //Fin del metodo para generar un pdf

    /**Buscar un producto por codigo en la base de datos */
    function buscar_producto()
    {
        if (is_login()) {
            if (getSegment(3)) {
                $productosModel = new ProductosModel();
                return json_encode($productosModel->getByGnl(getSegment(3)));
            }

            return false;
        } else
            return json_encode(array(
                'error' => 'Debe iniciar sesión para continuar'
            ));
    } //Fin de la funcion buscar_producto

    public function reporte()
    {
        if (is_login()) {
            $claves = array();

            $reporte = new Reportes();

            foreach ($_POST['documentos'] as $key => $value) {
                $id_documento = $_POST['documentos'][$key];

                $claves[] = $id_documento;
            }

            return json_encode($reporte->generar_reporte_documentos($claves, getSegment(3)));
        } else
            return json_encode(array(
                'error' => 'Debe iniciar sesión para continuar',
            ));
    } //Fin de la funcion descargar_reporte
}//Fin de la clase
