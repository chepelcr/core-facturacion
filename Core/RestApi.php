<?php

namespace Core;

abstract class RestApi {
    /**
     * Url base de la API
     */
    private $url = "";

    private $headers = array();

    private const ERROR_RESPONSE = "Ha ocurrido un error al realizar la solicitud";

    private $isArray = true;

    /**
     * Constructor de la clase
     */
    public function __construct($url, $contentType = "application/json", $isArray = false) {
        $this->url = $url;
        $this->headers["Content-Type"] = $contentType;
        $this->isArray = $isArray;
    }

    /**
     * Agrega el token de acceso a la API
     */
    public function setBearerToken($token) {
        $this->headers["Authorization"] = "Bearer ".$token;
    }

    private function constructUrl($url) {
        return $this->url.$url;
    }

    public function addHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    public function setContentType($contentType) {
        $this->headers["Content-Type"] = $contentType;
    }

    private function createHeaders(){
        if(count($this->headers) > 0) {
            foreach($this->headers as $key => $value) {
                $headers[] = $key.": ".$value;
            }
        }

        return $headers;
    }

    public function makeGetRequestUrl($url) {
        $url = $this->constructUrl($url);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        # Agregar todos los headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->createHeaders());

        #Set timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
        
        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            
            $className = get_class($this);

            insertError(curl_error($curl), $className);

            $response = array(
                "error" => self::ERROR_RESPONSE
            );
        } else {
            $response = json_decode($response, $this->isArray);
        }

        curl_close($curl);
        
        return $response;
    }

    /**
     * Crea una solicitud POST
     */
    public function makePostRequest($data, $url = "") {
        $url = $this->url . $url;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        # Agregar todos los headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->createHeaders());

        #Set timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);

        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            $response = array(
                "error"=> self::ERROR_RESPONSE
            );
        } else {
            $response = json_decode($response, $this->isArray);
        }

        curl_close($curl);
        
        return $response;
    }

    /**
     * Crea una solicitud PUT
     */
    public function makePutRequest($data, $url = "") {
        $url = $this->url . $url;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        
        # Agregar todos los headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->createHeaders());

        #Set timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            $response = array(
                "error"=> self::ERROR_RESPONSE
            );
        } else {
            $response = json_decode($response, $this->isArray);
        }

        curl_close($curl);
        
        return $response;
    }

    public function makePatchRequest($data, $url = "") {
        $url = $this->url . $url;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        
        # Agregar todos los headers
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->createHeaders());

        #Set timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            $response = array(
                "error"=> self::ERROR_RESPONSE
            );
        } else {
            $response = json_decode($response, $this->isArray);
        }

        curl_close($curl);
        
        return $response;
    }
}