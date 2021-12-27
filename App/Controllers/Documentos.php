<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Librerias\Hacienda;
use App\Librerias\Myqr;
use App\Librerias\Pdf_Manager;
use App\Models\ClientesModel;
use App\Models\CodigosPaisesModel;
use App\Models\ConsecutivosModel;
use App\Models\DocumentoDetallesModel;
use App\Models\DocumentoModel;
use App\Models\EmpresasModel;
use App\Models\ProductosModel;
use App\Models\TipoIdentificacionModel;
use App\Models\TiposDocumentosModel;
use App\Models\UbicacionesModel;
use Core\Config\Header;
use DOMDocument;

class Documentos extends BaseController
{
    public function index()
    {
        if(is_login())
        {
            $script = '<script>
                $(document).ready(function(){
                    cargar_inicio_modulo("documentos");
                });
            </script>';

            $data = array(
                'script' => $script,
            );

            return $this->inicio($data);
        }//Fin de la validacion

        else
            header('Location: '.baseUrl('login'));
    }//Fin de la funcion index

    public function cargar_documentos()
    {
        if(is_login())
        {
            $this->modelName = 'documento';

            $model = $this->model();

            $model->where('id_empresa', getSession('id_empresa'));

            $documentos = $model->getAll();

            $dataView = array(
                'documentos' => $documentos,
            );
            
            return view('facturacion/listado', $dataView);
        }
    }

    /**Obtener todos los productos */
    public function get_productos()
    {
        if(is_login())
        {
            $this->modelName = 'productos';

            $model = $this->model();

            $model->where('id_empresa', getSession('id_empresa'));

            $productos = $model->getAll();

            $dataView = array(
                'productos' => $productos,
            );
            
            return view('facturacion/table_productos', $dataView);
        }
    }//Fin de la funcion get_productos

    /**Obtener todos los clientes */
    public function get_clientes()
    {
        if(is_login())
        {
            $this->modelName = 'clientes';

            $model = $this->model();

            $model->where('id_empresa', getSession('id_empresa'));

            $clientes = $model->getAll();

            $dataView = array(
                'clientes' => $clientes,
            );
            
            return view('facturacion/table_clientes', $dataView);
        }
    }//Fin de la funcion get_clientes

    private function documento($tipo_documento = '01', $numero_documento)
    {
            $nombreVista = 'empresa/facturacion/crear';

            $tiposDocumentosModel = new TiposDocumentosModel();
            $ubicacionesModel = new UbicacionesModel();

            $tipoIdentificacionesModel = new TipoIdentificacionModel();
            $codigosPaisesModel = new CodigosPaisesModel();

            $modalCliente = array(
                'numero_documento'=>$numero_documento,
                'buscar_cliente'=>array(
                    'numero_documento'=>$numero_documento,
                    'dataForm' => array(
                        'datos_personales' => array(
                            'identificaciones' => $tipoIdentificacionesModel->getAll(),
                            'codigos' => $codigosPaisesModel->getAll(),
                        ),

                        'dataProvincias' => array(
                            'provincias' => $ubicacionesModel->provincias(),
                        ),
                    )),
            );

            $modalCierreDocumento = array(
                'numero_documento'=>$numero_documento,
                'tipo_documento'=>$tipo_documento,
            );

            $dataView = array(
                'id_tipo_documento' => $tipo_documento,
                'tipos_documentos' => $tiposDocumentosModel->getAll(),
                'numero_documento' => $numero_documento,
                'modalCliente' => $modalCliente,
                'modalCierreDocumento' => $modalCierreDocumento,
            );

            return view($nombreVista, $dataView);
    }

    /**Emitir un tiquete electronico */
    public function tiquete()
    {
        if (is_login()) {
            $id_tipo_documento = '04';

            $numero_documento = getSegment(3);

            return $this->documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para emitir un tiquete electronico

    public function factura()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '01';

            return $this->documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin del index

    /**Emitir una nota de credito (03) */
    public function nota_credito()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '03';

            return $this->documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin del index

    /**Emitir una nota de debito (02) */
    public function nota_debito()
    {
        if (is_login()) {

            $numero_documento = getSegment(3);

            $id_tipo_documento = '02';

            return $this->documento($id_tipo_documento, $numero_documento);
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin del index

    /**Obtener un boton para el nuevo documento */
    public function get_boton()
    {
        if (is_login()) {
            $numero_documento = getSegment(3);

            $boton = view('empresa/facturacion/boton', array('numero_documento' => $numero_documento));

            return $boton;
        } //Fin de la validacion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion get_boton

    public function buscar_cliente()
    {
        if (is_login()) {
            if (getSegment(3)) {
                $identificacion = getSegment(3);

                $clientesModel = new ClientesModel();
                $cliente = $clientesModel->getByIdentificacion($identificacion);

                if ($cliente) {
                    return json_encode($cliente);

                } //Fin del if

                else {
                    $data = array(
                        'error' => 'No se encontro el cliente',
                    );

                    return json_encode($data);
                } //Fin del else
            }
        } //Fin de la validacion

        else
            $data = array(
                'error' => 'No ha iniciado sesión'
            );
    } //Fin de la funcion buscar_cliente

    private function generar_pdf($clave)
    {
        $pdf = new Pdf_Manager();
        $qr = new Myqr();

        $DocumentosModel = new DocumentoModel();
        $documento =  $DocumentosModel->getDocumento($clave);

        if ($documento) {
            $DocumentosDetallesModel = new DocumentoDetallesModel();

            $detalles =  $DocumentosDetallesModel->getDocumentoDetalles($documento->id_documento);


            $dataQR = array(
                'url' => baseUrl('/documentos/pdf/' . $documento->clave),
            );

            $logoImg = file_get_contents(getFile('dist/img/logo.jpg'));


            $dataPdf = array(
                'nombre_archivo' => "pdf\\" . $documento->clave . ".pdf",
                'documento' => $documento,
                'detalles' => $detalles,
                "qrCodigo" => $qr->codigoQR($dataQR),
                "logo" => base64_encode($logoImg),
            );
            $pdf->save_view("pdfs/facturaPDF", $dataPdf);
        } else {
            echo "Documento no existe";
        }
    }

    public function ver_pdf()
    {
        if (is_login()) {
            $clave = getSegment(3);

            $dataView = array(
                'clave' => $clave
            );

            $nombreVista = 'facturacion/modalVerPdf';

            return view($nombreVista, $dataView);
        } else
            header('Location: ' . baseUrl());
    }

    public function guardar($objeto = null)
    {
        if (is_login()) {
            $id_cliente = post('identificacion_cliente');

            $id_tipo_documento = post('id_tipo_documento');

            $moneda = post('moneda');
            $tipo_cambio = post('tipo_cambio');

            $medio_pago = post('medio_pago');
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
            $surcusal = "001";
            $pv = "00002";
            $tipoDocumento = $id_tipo_documento;

            $consecutivo = $surcusal . $pv . $tipoDocumento . $factura;

            $notas = post('notas');

            $empresasModel = new EmpresasModel();
            $emisor = $empresasModel->getById(getSession('id_empresa'));

            $cod = $emisor->codigo_telefono;
            $ced = $emisor->identificacion;
            $cedulaEmisor = str_pad($ced, 12, "0", STR_PAD_LEFT);
            $situacion = "1";

            $codigoSeguridad = substr(str_shuffle("0123456789"), 0, 8);

            $clave = $cod . date('d') . date('m') . date('y') . $cedulaEmisor . $consecutivo . $situacion . $codigoSeguridad;

            $clientesModel = new ClientesModel();
            $receptor = $clientesModel->getByIdentificacion($id_cliente);

            $stringXML = '<?xml version="1.0" encoding="utf-8"?>
        <FacturaElectronica xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica">
            <Clave>' . $clave . '</Clave>
            <CodigoActividad>172101</CodigoActividad>
            <NumeroConsecutivo>' . $consecutivo . '</NumeroConsecutivo>
            <FechaEmision>' . date("c") . '</FechaEmision>
            <Emisor>
                <Nombre>' . $emisor->razon . '</Nombre>
                <Identificacion>
                    <Tipo>' . $emisor->id_tipo_identificacion . '</Tipo>
                    <Numero>' . $emisor->identificacion . '</Numero>
                </Identificacion>
                <NombreComercial>JR</NombreComercial>
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
            </Emisor>
            <Receptor>
                <Nombre>' . $receptor->razon . '</Nombre>
                <Identificacion>
                    <Tipo>' . $receptor->id_tipo_identificacion . '</Tipo>
                    <Numero>' . $receptor->identificacion . '</Numero>
                </Identificacion>
                <NombreComercial/>
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
            </Receptor>
            <CondicionVenta>' . $condicion_venta . '</CondicionVenta>
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

            foreach ($_POST['codigo'] as $key => $linea) {
                $stringXML .= '<LineaDetalle>
                    <NumeroLinea>' . ($key + 1) . '</NumeroLinea>
                    <Codigo>' . $_POST['codigo'][$key] . '</Codigo>
                    <Cantidad>' . $_POST['cantidad'][$key] . '</Cantidad>
                    <UnidadMedida>' . $_POST['unidad'][$key] . '</UnidadMedida>
                    <Detalle>' . $_POST['detalle'][$key] . '</Detalle>
                    <PrecioUnitario>' . $_POST['precio_unidad'][$key] . '</PrecioUnitario>
                    <MontoTotal>' . $_POST['monto_total'][$key] . '</MontoTotal>';

                if ($_POST['monto_descuento'][$key] > 0) {
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
                if ($_POST['unidad'][$key] == "Sp" || $_POST['unidad'][$key] == "Spe") {
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
            }

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
                //"fecha_envio" => "",
                //"fecha_valido" => "",
                "id_usuario" => getSession('id_usuario')
            );

            $documentosModel = new DocumentoModel();

            $id_documento = $documentosModel->insert($data_factura);

            if ($id_documento) {
                foreach ($_POST['codigo'] as $key => $linea) {
                    //insertar cada detalle
                    $documentosDetallesModel = new DocumentoDetallesModel();

                    $codigo = $_POST['codigo'][$key];
                    $nombre = $_POST['detalle'][$key];

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
                } //Fin del ciclo para insertar los detalles


                $stringXML .= '</DetalleServicio>
                    <ResumenFactura>
                        <CodigoTipoMoneda>
                            <CodigoMoneda>CRC</CodigoMoneda>
                            <TipoCambio>1</TipoCambio>
                        </CodigoTipoMoneda>
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
                    </ResumenFactura>
                    <Otros>
                        <OtroTexto></OtroTexto>
                    </Otros>
                </FacturaElectronica>';

                $salida = "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\p_firmar\\$clave.xml";
                $doc = new DOMDocument();
                $doc->preseveWhiteSpace = false;
                $doc->loadXml($stringXML);
                $doc->save($salida);
                $doc->saveXML();

                //generar PDF
                $this->generar_pdf($clave);

                $hacienda = new Hacienda();

                $xml64 = $hacienda->firmarXml($clave);

                $enviar = json_decode($hacienda->enviarXml($xml64));

                if ($enviar->status >= 200 && $enviar->status < 300) {
                    //actualizar enviado-----
                    sleep(4);
                    $validar =  json_decode($hacienda->validarXml($xml64), true);
                    if (isset($validar['xml']['ind-estado'])) {
                        if ($validar['xml']['ind-estado'] != "procesando") {

                            //actualizar validado-----

                            $json = json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))));
                            if ($json->Mensaje < 3) {
                                //enviar el correo
                                $cuerpo = '<h1>Factura generada</h1>';
                                $cuerpo .= "<p>Señores " . $receptor->razon . " se les adjunta la factura electronica.</p>";
                                $cuerpo .= "<b>Att " . $emisor->razon . "</b>";

                                $correos = array(
                                    $receptor->nombre => $receptor->correo,
                                    $emisor->nombre => $emisor->correo,
                                );
                            } else {
                                $cuerpo = '<h1>Error al generar factura</h1>';
                                $cuerpo .= "Error hacienda: " . $json->DetalleMensaje;
                                $correos  = array(
                                    'Jose Pablo Campos' => "proyectojpgrow@gmail.com",
                                );
                            }

                            $adjuntos = array(
                                $clave . '.pdf' => "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\pdf\\" . $clave . ".pdf",
                                $clave . '.xml' => "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\firmados\\" . $clave . "_f.xml",
                                $clave . '_respuesta_MH.xml' => "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\respuesta\\" . $clave . ".xml",
                            );

                            $data = array(
                                'receptor' => $correos,
                                'asunto' => 'Factura electronica',
                                'body' => $cuerpo,
                                'adjuntos' => $adjuntos,
                            );

                            $mail = new Correo();
                            $correo_enviado = $mail->enviarCorreo($data);

                            return json_encode(array(
                                'clave' => $clave,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => $json->Mensaje,
                                "validar_mensaje" => $json->DetalleMensaje,
                                "correo_enviado" => $correo_enviado,
                                'estado' => 'success',
                            ));
                        } else {
                            return json_encode(array(
                                'clave' => $clave,
                                "enviar" => $enviar->status,
                                "validar_estado" => $validar['xml']['ind-estado'],
                                "mensaje" => "Procesando",
                                "validar_mensaje" => "Procesando documento",
                                "correo_enviado" => false,
                                'estado' => 'warning',
                            ));
                        }
                    } else {
                        return json_encode(array(
                            'clave' => $clave,
                            "enviar" => $enviar->status,
                            "validar_estado" => $validar->status,
                            "mensaje" => "Error",
                            "validar_mensaje" => 'Se ha generado un error al validar la factura',
                            "correo_enviado" => false,
                            'estado' => 'error',
                        ));
                    }
                } else {
                    return json_encode(array(
                        'clave' => $clave,
                        "enviar" => $enviar->status,
                        "validar_estado" => "",
                        "mensaje" => "Error",
                        "validar_mensaje" => 'Se ha generado un error al enviar la factura',
                        "correo_enviado" => false,
                        'estado' => 'error',
                    ));
                }
            } //Fin de validacion de insercion y envio de correo

            else {
                return json_encode(array(
                    'error' => 'Error al insertar el documento'
                ));
            }
        } //Fin de validacion de logueo

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion create

    /**Enviar un documento al MH */
    public function enviar_mh()
    {
        if (is_login()) {
        } //Fin de la funcion

        else
            header('Location: ' . baseUrl());
    } //Fin de la funcion para firmar y enviar un documento al MH

    public function descargar_pdf()
    {
        if (is_login()) {
            $clave = getSegment(3);

            $pdf = new Pdf_Manager();
            $qr = new Myqr();

            $DocumentosModel = new DocumentoModel();

            $documento = $DocumentosModel->getDocumento($clave);

            if ($documento) {
                $documentosDetallesModel = new DocumentoDetallesModel();
                $documentosDetallesModel->where('id_documento', $documento->id_documento);

                $detalles = $documentosDetallesModel->getAll();

                $dataQR = array(
                    'url' => baseUrl("documentos/pdf/" . $documento->clave),
                );

                $qrCodigo = $qr->codigoQR($dataQR);

                $logoimg = file_get_contents(getFile('dist/img/logo.jpg'));

                $logo = base64_encode($logoimg);

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

    public function pdf()
    {
        if (is_login()) {
            $clave = getSegment(3);

            $pdf = new Pdf_Manager();
            $qr = new Myqr();

            $DocumentosModel = new DocumentoModel();

            $documento = $DocumentosModel->getDocumento($clave);

            if ($documento) {
                $documentosDetallesModel = new DocumentoDetallesModel();
                $documentosDetallesModel->where('id_documento', $documento->id_documento);

                $detalles = $documentosDetallesModel->getAll();

                $dataQR = array(
                    'url' => baseUrl("documentos/pdf/" . $documento->clave),
                );

                $qrCodigo = $qr->codigoQR($dataQR);

                $logoimg = file_get_contents(getFile('dist/img/logo.jpg'));

                $logo = base64_encode($logoimg);

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
        } //Fin de validacion login

        else
            header('Location: ' . baseUrl());
    } //Fin del metodo para generar un pdf
}//Fin de la clase
