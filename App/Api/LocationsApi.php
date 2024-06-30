<?php

namespace App\Api;

class LocationsApi extends IvoisApi {

    const STATES_URL = "/states/";

    const COUNTIES_URL = "/counties/";

    const DISTRICTS_URL = "/districts/";

    const NEIGHBORHOODS_URL = "/neighborhoods/";


    /**
     * Constructor de la clase
     */
    public function __construct() {
        parent::__construct(getEnt("ivois.api.countries.url"));
    }

    /**
     * Obtener los paises desde la API de IVOIS
     */
    public function get_countries() {
        $countries_url = getEnt("ivois.api.url.all");

        return $this->makeGetRequestUrl($countries_url);
    }

    /**
     * Obtener las provincias de un país.
     */
    public function get_states_by_iso_code($iso_code) {
        
        $states_url = $iso_code . self::STATES_URL;

        return $this->makeGetRequestUrl($states_url);
    }

    /**
     * Obtener los cantones de una provincia por su id y el pais.
     */
    public function get_counties_by_state_id_and_iso_code($state_id, $iso_code) {
        $states_url = $iso_code.self::STATES_URL.$state_id.self::COUNTIES_URL;

        return $this->makeGetRequestUrl($states_url);
    }

    /**
     * Obtener las obtener los distritos de un canton por provincia, canton y pais.
     */
    public function get_districts_by_county_id_and_state_id_and_iso_code($county_id, $state_id, $iso_code) {
        $states_url = $iso_code.self::STATES_URL.$state_id.self::COUNTIES_URL.$county_id.self::DISTRICTS_URL;

        return $this->makeGetRequestUrl($states_url);
    }

    /**
     * Obtener las obtener los barrios de un distrito por provincia, canton, distrito y pais.
     */
    public function get_neighborhoods_by_district_id_and_county_id_and_state_id_and_iso_code($district_id, $county_id, $state_id, $iso_code) {
        $states_url = $iso_code.self::STATES_URL.$state_id.self::COUNTIES_URL.$county_id.self::DISTRICTS_URL.$district_id.self::NEIGHBORHOODS_URL;

        return $this->makeGetRequestUrl($states_url);
    }
}