<?php

namespace App\Api;

class DataServiceApi extends IvoisApi {
    public function getIdentificationTypesByCountry($countryCode){
        /*$url = getEnt("ivois.api.countries.url").$countryCode.getEnt("ivois.api.identifications.url");

        return $this->makeGetRequestUrl($url);*/

        $example_data = '[
            {
                "typeId": 2,
                "code": "02",
                "description": "Cédula Juridica",
                "countryCode": "188",
                "createdOn": "2024-02-20T13:54:04.932+00:00",
                "updatedOn": "2024-02-20T13:54:04.932+00:00",
                "status": 1
            },
            {
                "typeId": 3,
                "code": "03",
                "description": "DIMEX",
                "countryCode": "188",
                "createdOn": "2024-02-20T13:54:05.742+00:00",
                "updatedOn": "2024-02-20T13:54:05.742+00:00",
                "status": 1
            },
            {
                "typeId": 4,
                "code": "04",
                "description": "NITE",
                "countryCode": "188",
                "createdOn": "2024-02-20T13:54:06.351+00:00",
                "updatedOn": "2024-02-20T13:54:06.351+00:00",
                "status": 1
            },
            {
                "typeId": 5,
                "code": "99",
                "description": "Otros",
                "countryCode": "188",
                "createdOn": "2024-02-20T13:54:07.025+00:00",
                "updatedOn": "2024-02-20T13:54:07.025+00:00",
                "status": 1
            },
            {
                "typeId": 1,
                "code": "01",
                "description": "Cédula Fisica",
                "countryCode": "188",
                "createdOn": "2024-02-20T13:54:04.290+00:00",
                "updatedOn": "2024-06-04T21:40:47.476+00:00",
                "status": 1
            }
        ]';

        return json_decode($example_data, false);
    }
}
