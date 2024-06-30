<?php

namespace App\Api;

class CustomersApi extends IvoisApi {

    public function __construct($taxpayerId) {
        parent::__construct(getEnt("ivois.api.taxpayers.url").$taxpayerId.getEnt("ivois.api.customers.url"));
    }

    /**
     * Obtiene un cliente por su id
     */
    public function getCustomerById($id) {
        /*$example_data = '{
            "id": 5,
            "businessName": "Sirlene del Carmen Vega Gonzalez",
            "identification": {
                "number": "207710445",
                "code": "01",
                "typeId": 1,
                "description": "Cédula Fisica"
            },
            "nationality": {
                "isoCode": "188",
                "name": "Costa Rica",
                "iso": "CR",
                "currencyCode": "CRC",
                "phoneCode": "506",
                "timeZone": "GMT-06:00",
                "serviceStatus": 1
            },
            "residence": {
                "id": 1878,
                "countryCode": "188",
                "countryName": "Costa Rica",
                "stateId": 2,
                "stateName": "ALAJUELA",
                "countyId": 2,
                "countyName": "SAN RAMÓN",
                "districtId": 1,
                "districtName": "SAN RAMÓN",
                "neighborhoodId": 1,
                "neighborhoodName": "SAN RAMÓN centro",
                "address": "Piedades Sur."
            },
            "personalPhone": {
                "countryCode": "188",
                "areaCode": "506",
                "number": 24478245,
                "description": "Personal"
            },
            "businessPhone": {
                "countryCode": "188",
                "areaCode": "506",
                "number": 87351446,
                "description": "Oficina"
            },
            "email": "jcampos@interfaz.io",
            "createdOn": "2024-06-10T16:12:24.829+00:00",
            "updatedOn": "2024-06-10T16:12:24.829+00:00",
            "status": 1,
            "activities": [
                {
                    "code": "521202",
                    "description": "Pulperias ( mini-super)(sin cantina)",
                    "status": "Activa",
                    "type": "Secundaria"
                },
                {
                    "code": "522004",
                    "description": "Venta de verduras y frutas",
                    "status": "Activa",
                    "type": "Primaria"
                },
                {
                    "code": "522010",
                    "description": "Venta de embutidos y carnes (res, pollo, cerdo)incluidas enla canasta basica",
                    "status": "Activa",
                    "type": "Secundaria"
                }
            ]
        }';

        return json_decode($example_data, false);*/
        return $this->makeGetRequestUrl($id);
    }

    /**
     * Obtener todos los clientes de un contribuyente
     */
    public function getCustomersByTaxpayerId() {
        return $this->makeGetRequestUrl('all');

        /*$example_data = '[
            {
                "id": 4,
                "businessName": "Luis Arturo Villar Sudek",
                "identification": {
                    "number": "VISL910320HPLLDS09",
                    "code": "99",
                    "typeId": 6,
                    "description": "Otros"
                },
                "nationality": {
                    "isoCode": "52",
                    "name": "Barbados",
                    "iso": "BB",
                    "currencyCode": "BBD",
                    "phoneCode": "(null)",
                    "timeZone": "(null)",
                    "serviceStatus": 2
                },
                "residence": {
                    "id": 0,
                    "countryCode": "52",
                    "countryName": "Barbados",
                    "stateName": "Otros",
                    "countyName": "Otros",
                    "districtName": "Otros",
                    "neighborhoodName": "Otros",
                    "address": "Mexico"
                },
                "personalPhone": {
                    "countryCode": "52",
                    "areaCode": "(null)",
                    "number": 88888888,
                    "description": "Personal"
                },
                "email": "jcampos@interfaz.io",
                "createdOn": "2024-06-10T16:01:08.874+00:00",
                "updatedOn": "2024-06-10T16:01:08.874+00:00",
                "status": 1
            },
            {
                "id": 5,
                "businessName": "Sirlene del Carmen Vega Gonzalez",
                "identification": {
                    "number": "207710445",
                    "code": "01",
                    "typeId": 1,
                    "description": "Cédula Fisica"
                },
                "nationality": {
                    "isoCode": "188",
                    "name": "Costa Rica",
                    "iso": "CR",
                    "currencyCode": "CRC",
                    "phoneCode": "506",
                    "timeZone": "GMT-06:00",
                    "serviceStatus": 1
                },
                "residence": {
                    "id": 1878,
                    "countryCode": "188",
                    "countryName": "Costa Rica",
                    "stateId": 2,
                    "stateName": "ALAJUELA",
                    "countyId": 2,
                    "countyName": "SAN RAMÓN",
                    "districtId": 1,
                    "districtName": "SAN RAMÓN",
                    "neighborhoodId": 1,
                    "neighborhoodName": "SAN RAMÓN centro",
                    "address": "Piedades Sur."
                },
                "personalPhone": {
                    "countryCode": "188",
                    "areaCode": "506",
                    "number": 24478245,
                    "description": "Personal"
                },
                "businessPhone": {
                    "countryCode": "188",
                    "areaCode": "506",
                    "number": 87351446,
                    "description": "Oficina"
                },
                "email": "jcampos@interfaz.io",
                "createdOn": "2024-06-10T16:12:24.829+00:00",
                "updatedOn": "2024-06-10T16:12:24.829+00:00",
                "status": 1,
                "activities": [
                    {
                        "code": "521202",
                        "description": "Pulperias ( mini-super)(sin cantina)",
                        "status": "Activa",
                        "type": "Secundaria"
                    },
                    {
                        "code": "522004",
                        "description": "Venta de verduras y frutas",
                        "status": "Activa",
                        "type": "Primaria"
                    },
                    {
                        "code": "522010",
                        "description": "Venta de embutidos y carnes (res, pollo, cerdo)incluidas enla canasta basica",
                        "status": "Activa",
                        "type": "Secundaria"
                    }
                ]
            }
        ]';

        return json_decode($example_data, false);*/
    }

    /**
     * Obtener todos los clientes de un contribuyente por su estado
     */
    public function getCustomersByStatus($status) {
        $url = "all?status=$status";

        return $this->makeGetRequestUrl($url);

        /*$example_data = '[
            {
                "id": 4,
                "businessName": "Luis Arturo Villar Sudek",
                "identification": {
                    "number": "VISL910320HPLLDS09",
                    "code": "99",
                    "typeId": 6,
                    "description": "Otros"
                },
                "nationality": {
                    "isoCode": "52",
                    "name": "Barbados",
                    "iso": "BB",
                    "currencyCode": "BBD",
                    "phoneCode": "(null)",
                    "timeZone": "(null)",
                    "serviceStatus": 2
                },
                "residence": {
                    "id": 0,
                    "countryCode": "52",
                    "countryName": "Barbados",
                    "stateName": "Otros",
                    "countyName": "Otros",
                    "districtName": "Otros",
                    "neighborhoodName": "Otros",
                    "address": "Mexico"
                },
                "personalPhone": {
                    "countryCode": "52",
                    "areaCode": "(null)",
                    "number": 88888888,
                    "description": "Personal"
                },
                "email": "jcampos@interfaz.io",
                "createdOn": "2024-06-10T16:01:08.874+00:00",
                "updatedOn": "2024-06-10T16:01:08.874+00:00",
                "status": 1
            },
            {
                "id": 5,
                "businessName": "Sirlene del Carmen Vega Gonzalez",
                "identification": {
                    "number": "207710445",
                    "code": "01",
                    "typeId": 1,
                    "description": "Cédula Fisica"
                },
                "nationality": {
                    "isoCode": "188",
                    "name": "Costa Rica",
                    "iso": "CR",
                    "currencyCode": "CRC",
                    "phoneCode": "506",
                    "timeZone": "GMT-06:00",
                    "serviceStatus": 1
                },
                "residence": {
                    "id": 1878,
                    "countryCode": "188",
                    "countryName": "Costa Rica",
                    "stateId": 2,
                    "stateName": "ALAJUELA",
                    "countyId": 2,
                    "countyName": "SAN RAMÓN",
                    "districtId": 1,
                    "districtName": "SAN RAMÓN",
                    "neighborhoodId": 1,
                    "neighborhoodName": "SAN RAMÓN centro",
                    "address": "Piedades Sur."
                },
                "personalPhone": {
                    "countryCode": "188",
                    "areaCode": "506",
                    "number": 24478245,
                    "description": "Personal"
                },
                "businessPhone": {
                    "countryCode": "188",
                    "areaCode": "506",
                    "number": 87351446,
                    "description": "Oficina"
                },
                "email": "jcampos@interfaz.io",
                "createdOn": "2024-06-10T16:12:24.829+00:00",
                "updatedOn": "2024-06-10T16:12:24.829+00:00",
                "status": 1,
                "activities": [
                    {
                        "code": "521202",
                        "description": "Pulperias ( mini-super)(sin cantina)",
                        "status": "Activa",
                        "type": "Secundaria"
                    },
                    {
                        "code": "522004",
                        "description": "Venta de verduras y frutas",
                        "status": "Activa",
                        "type": "Primaria"
                    },
                    {
                        "code": "522010",
                        "description": "Venta de embutidos y carnes (res, pollo, cerdo)incluidas enla canasta basica",
                        "status": "Activa",
                        "type": "Secundaria"
                    }
                ]
            }
        ]';

        return json_decode($example_data, false);*/
    }

    /**
     * Cambiar el estado de un cliente
     */
    public function changeCustomerStatus($id, $data) {
        return $this->makePatchRequest($id, $data);
    }

    /**
     * Actualizar un cliente
     */
    public function updateCustomer($id, $data) {
        return $this->makePutRequest($id, $data);
    }

    public function getCustomerByNationalityAndIdNumber($nationality, $idNumber) {
        $url = "exists?nationality=$nationality&idNumber=$idNumber";

        return $this->makeGetRequestUrl($url);
    }
}
