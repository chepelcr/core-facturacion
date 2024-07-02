<?php

namespace App\Api;

class DetailsApi extends IvoisApi {
    /**
     * Id al cual pertenecen los detalles
     */
    private $taxpayerId;

    private $productsUrl;

    /**
     * Constructor de la clase
     */
    public function __construct($taxpayerId) {
        parent::__construct(getEnt("ivois.api.taxpayers.url"));

        $this->productsUrl = getEnt("ivois.api.details.products.url");

        $this->taxpayerId = $taxpayerId;
    }

    /**
     * Obtiene un detalle por su id y el id del contribuyente
     */
    public function getProductById($id) {
        $url = $this->productsUrl;
        $url = $url."$id?taxpayerId=$this->taxpayerId";

        $product = $this->makeGetRequestUrl($url);

        $product = json_encode($product);
        
        return json_decode($product, true);
    }

    /**
     * Obtiene todos los detalles de un contribuyente
     */
    public function getProductsByTaxpayerId() {
        $url = $this->productsUrl;
        $url = $url."all?taxpayerId=$this->taxpayerId";

        $products = $this->makeGetRequestUrl($url);

        $products = json_encode($products);
        
        return json_decode($products, true);
    }

    /**
     * Obtiene todos los detalles de un contribuyente aplicando un filtro de busqueda
     */
    public function getProductsBySearchFilter($searchFilter) {
        $url = $this->productsUrl;
        $url = $url."all?taxpayerId=$this->taxpayerId&search=$searchFilter";

        return $this->makeGetRequestUrl($url);
    }

    /**
     * Almacena la información de un detalle
     */
    public function saveProduct($data) {
        $url = $this->productsUrl;

        $product = $this->makePostRequest($data, $url);

        return (object) $product;
    }

    /**
     * Actualiza la información de un detalle
     */
    public function updateDetail($id, $data) {
        $url = $this->productsUrl.$id."?taxpayerId=$this->taxpayerId";

        $product = $this->makePutRequest($data, $url);

        return (object) $product;
    }

    /**
     * Cambia el estado de un detalle
     */
    public function changeProductStatus($id, $data) {
        $url = $this->productsUrl.$id."?taxpayerId=$this->taxpayerId";

        $product = $this->makePatchRequest($data, $url);

        return (object) $product;
    }
}
