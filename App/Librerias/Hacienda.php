<?php
namespace App\Librerias;

use App\Models\ClientesModel;
use App\Models\ConsecutivosModel;
use App\Models\DocumentoDetallesModel;
use App\Models\DocumentoModel;
use App\Models\EmpresasModel;

/**libreria para el manejo de documentos electronicos con base en los requerimientos del MH */
class Hacienda
{
    /** Obtener un token del ministerio de hacienda */
    private function token()
    {
        $data = array(
            'client_id' => getenv('factura.clientID'),
            'client_secret' => '',
            'grant_type' => 'password',
            'username' => getenv('factura.userToken'),
            'password' => getenv('factura.userPass')
        );

        $curl= curl_init(getenv('factura.tokenURL'));
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, 'Content-Type: application/x-www-form-urlencoded');
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response= curl_exec($curl);
        $respuesta= json_decode($response);
        $status= curl_getinfo($curl);
        curl_close($curl);
        return $respuesta->access_token;
    }//Fin de obtenerToken

    /**Fimar un documento XML */
    private function firmarXml($clave)
    {
        $p12= getenv('factura.p12');
        $pin=getenv('factura.pin');

        $input= "archivos/xml/p_firmar/".$clave.".xml";
        $ruta= "archivos/xml/firmados/".$clave."_f.xml";

        $Firmador = new Firmador();
        //firma y devuelve el base64_encode();
        $xml64=  $Firmador->firmarXml($p12,$pin,$input,$Firmador::TO_XML_FILE,$ruta);
        return  $xml64;
    }//Fin del firmador del documento

    /**Enviar un XML al ministerio de hacienda */
    public function enviarXml($xml64){

        $leer= json_encode(simplexml_load_string(base64_decode($xml64)));
        $json= json_decode($leer);

        $data= json_encode(array(
            "clave"=> $json->Clave,
            "fecha" => date('c'),
            "emisor"=>array(
                "tipoIdentificacion" => $json->Emisor->Identificacion->Tipo,
                "numeroIdentificacion" => $json->Emisor->Identificacion->Numero,
            ),
            "receptor" =>array(
                "tipoIdentificacion" => $json->Receptor->Identificacion->Tipo,
                "numeroIdentificacion" => $json->Receptor->Identificacion->Numero,
            ),
            "comprobanteXml"=> $xml64
        ));
        //token
        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );

        $curl = curl_init(getenv('factura.urlRecepcion'));
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        //ejecutar el curl
        $respuesta= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta
        return json_encode(array('respuesta' =>$respuesta, 'status'=>$status ));      //echo $status;
    }

    /**Actualizar un consecutivo */
    private function actualizarConsecutivo($consecutivo, $id_consecutivo)
    {
        $consecutivosModel = new ConsecutivosModel();

        $data = array(
            "consecutivo" => $consecutivo,
        );

        return $consecutivosModel->update($data, $id_consecutivo);
    }//Fin de la funcion


    /**Generar una factura XML*/
    public function generar_xml($id_documento)
    {
        $documentosModel = new DocumentoModel();
    
        $documento = $documentosModel->getById($id_documento);

        if($documento)
        {
            $id_tipo_documento = $documento->tipo_documento;

            $id_sucursal = getSession('id_sucursal');
            $id_punto_venta = getEnt('punto_venta.id');

            $ConsecutivosModel = new ConsecutivosModel();
            
            $ConsecutivosModel->where('id_punto', $id_punto_venta);
            $ConsecutivosModel->where('id_sucursal', $id_punto_venta);

            $ConsecutivosModel->where('ambiente', getEnt('factura.ambiente'));
            $ConsecutivosModel->where('tipo_documento', $id_tipo_documento);

            $consecutivo = $ConsecutivosModel->fila();

            $id_factura = $consecutivo->consecutivo;

            $this->actualizarConsecutivo($id_factura+1, $consecutivo->id_consecutivo);

            $factura = str_pad($id_factura,10,0,STR_PAD_LEFT);

            $sucursal = str_pad($id_sucursal,3,0,STR_PAD_LEFT);

            $pv = str_pad($id_punto_venta,5,0,STR_PAD_LEFT);

            $consecutivo = $sucursal.$pv.$id_tipo_documento.$factura;
            
            $empresasModel = new EmpresasModel();
            $emisor = $empresasModel->getById(getSession('id_empresa'));

            $cod= $emisor->codigo_telefono;
            $ced= $emisor->identificacion;
            $cedulaEmisor= str_pad($ced,12,"0",STR_PAD_LEFT);
            $situacion="1";

            $codigo_seguridad= substr(str_shuffle("0123456789"), 0, 8);

            $clave= $cod.date('d').date('m').date('y').$cedulaEmisor.$consecutivo.$situacion.$codigo_seguridad;



            $ClientesModel = new ClientesModel();

            $ClientesModel->where('identificacion', $documento->receptor_cedula);
            $receptor = $ClientesModel->fila();

            $stringXML='<?xml version="1.0" encoding="utf-8"?>
            <FacturaElectronica xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica">
                <Clave>'.$clave.'</Clave>
                <CodigoActividad>721001</CodigoActividad>
                <NumeroConsecutivo>'.$consecutivo.'</NumeroConsecutivo>
                <FechaEmision>'.date("c").'</FechaEmision>
                <Emisor>
                    <Nombre>'.$emisor->razon.'</Nombre>
                    <Identificacion>
                        <Tipo>'.$emisor->id_tipo_identificacion.'</Tipo>
                        <Numero>'.$emisor->identificacion.'</Numero>
                    </Identificacion>
                    <NombreComercial>JR</NombreComercial>
                    <Ubicacion>
                        <Provincia>'.$emisor->cod_provincia.'</Provincia>
                        <Canton>'.str_pad($emisor->cod_canton,2,"0",STR_PAD_LEFT).'</Canton>
                        <Distrito>'.str_pad($emisor->cod_distrito,2,"0",STR_PAD_LEFT).'</Distrito>
                        <Barrio>'.str_pad($emisor->cod_barrio,2,"0",STR_PAD_LEFT).'</Barrio>
                        <OtrasSenas>'.$emisor->otras_senas.'</OtrasSenas>
                    </Ubicacion>
                    <Telefono>
                        <CodigoPais>'.$emisor->codigo_telefono.'</CodigoPais>
                        <NumTelefono>'.$emisor->telefono.'</NumTelefono>
                    </Telefono>
                    <CorreoElectronico>'.$emisor->correo.'</CorreoElectronico>
                </Emisor>
                <Receptor>
                    <Nombre>'.$receptor->razon.'</Nombre>
                    <Identificacion>
                        <Tipo>'.$receptor->id_tipo_identificacion.'</Tipo>
                        <Numero>'.$receptor->identificacion.'</Numero>
                    </Identificacion>
                    <NombreComercial/>
                    <Ubicacion>
                        <Provincia>'.$receptor->cod_provincia.'</Provincia>
                        <Canton>'.str_pad($receptor->cod_canton,2,"0",STR_PAD_LEFT).'</Canton>
                        <Distrito>'.str_pad($receptor->cod_distrito,2,"0",STR_PAD_LEFT).'</Distrito>
                        <Barrio>'.str_pad($receptor->cod_barrio,2,"0",STR_PAD_LEFT).'</Barrio>
                        <OtrasSenas>'.$receptor->otras_senas.'</OtrasSenas>
                    </Ubicacion>
                    <Telefono>
                        <CodigoPais>'.$receptor->codigo_telefono.'</CodigoPais>
                        <NumTelefono>'.$receptor->telefono.'</NumTelefono>
                    </Telefono>
                    <CorreoElectronico>'.$receptor->correo.'</CorreoElectronico>
                </Receptor>
                <CondicionVenta>'.$documento->condicion_venta.'</CondicionVenta>
                <PlazoCredito>'.$documento->plazo_credito.'</PlazoCredito>
                <MedioPago>'.$documento->medio_pago.'</MedioPago>
                <DetalleServicio>';

                $documentosDetalles = new DocumentoDetallesModel();

                $documentosDetalles->where('id_documento', $id_documento);

                $detalles = $documentosDetalles->getAll();

                foreach ($detalles as $key => $detalle) 
                {
                    var_dump($detalle);
                    var_dump($key);

                    $stringXML.='<LineaDetalle>
                    <NumeroLinea>'.$detalle->linea.'</NumeroLinea>
                    <Codigo>'.$detalle->codigo.'</Codigo>
                    <Cantidad>'.$detalle->cantidad.'</Cantidad>
                    <UnidadMedida>'.$detalle->unidad_medida.'</UnidadMedida>
                    <Detalle>'.$detalle->detalle.'</Detalle>
                    <PrecioUnitario>'.$detalle->precio_unidad.'</PrecioUnitario>
                    <MontoTotal>'.$detalle->monto_total.'</MontoTotal>';

                    if ($detalle->monto_descuento>0) {
                       $stringXML.='<Descuento>
                            <MontoDescuento>'.$detalle->monto_descuento.'</MontoDescuento>
                            <NaturalezaDescuento>'.$detalle->motivo_descuento.'</NaturalezaDescuento>
                        </Descuento>';
                    }

                    $stringXML.='<SubTotal>'.$detalle->sub_total.'</SubTotal>
                    <Impuesto>
                        <Codigo>'.$detalle->codigo_impuesto.'</Codigo>
                        <CodigoTarifa>'.$detalle->codigo_tarifa.'</CodigoTarifa>
                        <Tarifa>'.$detalle->tarifa.'</Tarifa>
                        <Monto>'.$detalle->monto_impuesto.'</Monto>  
                    </Impuesto>
                    
                    <ImpuestoNeto>'.$detalle->impuesto_neto.'</ImpuestoNeto>
                    <MontoTotalLinea>'.$detalle->total_linea.'</MontoTotalLinea>
                </LineaDetalle>';
                }

        }

        echo $stringXML;
    }//Fin de la funcion para generar un archivo XML
}//Fin de la clase