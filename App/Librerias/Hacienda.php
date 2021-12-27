<?php
namespace App\Librerias;

use DOMDocument;

/**libreria para el manejo de documentos electronicos con base en los requerimientos del MH */
class Hacienda
{
    /** Obtener un token del ministerio de hacienda */
    private function token()
    {
        $data = array(
            'client_id' => getEnt('factura.clientID'),
            'client_secret' => '',
            'grant_type' => 'password',
            'username' => getEnt('factura.userToken'),
            'password' => getEnt('factura.userPass')
        );

        $curl= curl_init(getEnt('factura.tokenURL'));
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
    public function firmarXml($clave)
    {
        $p12 = getEnt('factura.p12');
        $pin = getEnt('factura.pin');

        $input = "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\p_firmar\\".$clave.".xml";

        $ruta = "F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\firmados\\".$clave."_f.xml";

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

        $curl = curl_init(getEnt('factura.urlRecepcion'));
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

    public function validarXml($xml64){
        $leer= json_encode(simplexml_load_string(base64_decode($xml64)));
        $json= json_decode($leer);
        //token
        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );

        $curl = curl_init(getEnt('factura.urlRecepcion')."/".$json->Clave);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        //ejecutar el curl
        $response= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta
        $xml= json_decode($response, true);

        if (isset($xml['respuesta-xml'])) {
            $respuesta_xml= $xml['respuesta-xml'];
            $stringXML= base64_decode($respuesta_xml);

            $salida="F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\respuesta\\".$json->Clave.".xml";
            $doc = new DomDocument();
            $doc->preseveWhiteSpace = false;
            $doc->loadXml($stringXML);
            $doc->save($salida);
        }

        return json_encode( array('response'=> $response , 'xml'=>$xml ));

    }//Fin de validarXML

    public function validar($clave){
        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );


        $curl = curl_init(getEnt('factura.urlRecepcion')."/".$clave);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        //ejecutar el curl
        $response= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta

        $xml= json_decode($response, true);

        if (isset($xml['respuesta-xml'])) {
            $respuesta_xml= $xml['respuesta-xml'];
            $stringXML= base64_decode($respuesta_xml);

            $salida="F:\\server\\htdocs\\modas-laura\\Sitema-costos\\public\\archivos\\xml\\respuesta\\".$clave.".xml";
            $doc = new DOMDocument();
            $doc->preseveWhiteSpace = false;
            $doc->loadXml($stringXML);
            $doc->save($salida);
        }

        return json_encode( array('response'=> $response , 'xml'=>$xml ));
    }
}//Fin de la clase