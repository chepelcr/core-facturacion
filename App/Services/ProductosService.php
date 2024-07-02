<?php

namespace App\Services;

use App\Api\DetailsApi;

use App\Models\CategoriasModel;
use App\Models\UnidadesMedidaModel;

class ProductosService extends BaseService {

    public function getData($id = 'all', $filters = array()) {
        $productosApi = new DetailsApi(getEnt('ivois.taxpayer.id'));

        if ($id == 'all') {
            if(!empty($filters) && isset($filters['search'])) {
                return $productosApi->getProductsBySearchFilter($filters['search']);
            } else {
                return $productosApi->getProductsByTaxpayerId();
            }
        } else {
            return (object) $productosApi->getProductById($id);
        }
    }

    public function changeStatus($id, $data) {
        $productosApi = new DetailsApi(getEnt('ivois.api.taxpayer.id'));

        return $productosApi->changeProductStatus($id, $data);
    }

    public function getProductsListView($filters = array()) {
        $productos = $this->getData('all', $filters);
 
        if(isset($productos->error)) {
            return $productos;
        }

        $estado = 'all';

        if(isset($filters['search'])) {
            # Separar los valores de la busqueda en un array (vienen separados por comas)
            $search = explode(',', $filters['search']);

            # Si existe el campo statusId en search, se asigna a la variable estado
            if(isset($search['statusId'])) {
                $estado = $search['statusId'];
            }
        }

        $nombreTabla = 'empresa/producto/table';

        $data_tabla = array(
            'nombreTable' => $nombreTabla,
            'nombre_tabla' => 'listado_empresa_productos',
            'dataTable' => array(
                 'articulos' => $productos
                ),
            'id_estado' => $estado
        );

        $categoriasModel = new CategoriasModel();
        $categorias = $categoriasModel->getAll();

        $unidadesMedidaModel = new UnidadesMedidaModel();
        $unidades = $unidadesMedidaModel->getAll();

        $nombreForm = 'empresa/producto/form';

        $data_form = array(
            'dataForm' => array(
                'categorias' => $categorias,
                'unidades' => $unidades,
            ),
            'nombreForm' => $nombreForm,
            'nombre_form' => 'frm_empresa_productos'
        );

        $data = array(
            'data_tabla' => $data_tabla,
            'data_form' => $data_form,
            'extra_views' => array(
                'empresa/producto/elementos/cabys' => null
            ),
        );

        return listado($data);
    }

    public function validarExistencia($data){
        #$productosApi = new DetailsApi(getEnt('taxpayerId'));

        #return $productosApi->validateProductExistence($data);
    }

    public function update($id, $data) {
        $productosApi = new DetailsApi(getEnt('ivois.api.taxpayer.id'));

        return $productosApi->updateDetail($id, $data);
    }

    public function create($data) {
        $productosApi = new DetailsApi(getEnt('ivois.api.taxpayer.id'));

        return $productosApi->saveProduct($data);
    }
}
