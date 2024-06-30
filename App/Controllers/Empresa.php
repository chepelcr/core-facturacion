<?php

/**
 * Controlador para la entidad cliente
 */

namespace App\Controllers;

use App\Services\ClientesService;
use App\Services\ProductosService;


class Empresa extends BaseController {
    const LOCATION = "'Location: '";
    
    protected $isModulo = true;
    protected $nombreModulo = 'empresa';
    protected $objetos = ['productos', 'clientes'];

    protected $validationFields = array(
        'productos' => [
            'codeType',
            'description',
            'codeNumber',
        ],
        #'sucursales' => null,
        'clientes' => [
            'nationality',
            'idNumber'
        ]
    );

    protected $loginValidation = array(
        'productos' => true,
        'sucursales' => true,
        'clientes' => true
    );
    
    public function index() {
        if (is_login()) {
            $script = '<script>
                    $(document).ready(function(){
                        cargar_inicio_modulo("empresa");
                    });
                </script>';

            $data = array(
                'script' => $script,
            );

            return $this->inicio($data);
        } //Fin de la validacion

        else {
            header(self::LOCATION . baseUrl('login'));
        }
    } //Fin de la función index

    /**Retornar la informacion de la empresa */
    public function informacion() {
        if (is_login()) {
            $script = '<!-- Perfil de empresa -->
                    <script type:text/javascript>
                        $(document).ready(function() {
                            cargar_listado("empresa", "informacion", "'.baseUrl("empresa/empresas").'");
                        });
                    </script>';

            $data = array(
                'script' => $script
            );

            return $this->inicio($data);
        }

        else {
            header(self::LOCATION . baseUrl('login'));
        }
    } //Fin de la función index

    public function clientes() {
        if (is_login()) {
            if (validar_permiso('empresa', 'clientes', 'consultar')) {
                if(getSegment(3) == 'listado') {
                    $clientesService = new ClientesService();
    
                    $clientesView = $clientesService->getCustomersListView($_GET);

                    //var_dump($clientesView);

                    if(isset($clientesView->error)) {
                        $data = array(
                            'error' => $clientesView->error,
                            'codigo' => $clientesView->status
                        );

                        return $this->error($data);
                    } else {
                        return $clientesView;
                    }
                } else {
                    $data = array(
                        'script' => '<!-- Cargar clientes -->
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            cargar_listado("empresa", "clientes", "' . baseUrl('empresa/clientes/listado') . '");
                                        });
                                    </script>'
                    );
    
                    return $this->inicio($data);
                }
            } else {
                $error = $this->object_error(500, 'No tiene permisos para consultar clientes.');

                return $this->error($error);
            }
        }

        else {
            header(self::LOCATION . baseUrl('login'));
        }
    } //Fin de la función para mostrar el listado de clientes

    public function productos() {
        if (is_login()) {
            if (validar_permiso('empresa', 'productos', 'consultar')) {
                if(getSegment(3) == 'listado'){
                    $productosService = new ProductosService();

                    return $productosService->getProductsListView($_GET);
                } else {
                    $script = '<script type="text/javascript" >
                        //Cuando el documento esta listo, cargar los productos
                        $(document).ready(function(){
                            cargar_listado("empresa", "productos", "' . baseUrl('empresa/productos/listado') . '");
                        });
                    </script>';

                    $data = array(
                        'script' => $script
                    );

                    return $this->inicio($data);
                }
            } else {
                $error = $this->object_error(403, 'No tiene permiso para realizar esta acción');

                return  $this->error($error);
            }
        } //Fin de la validacion

        else {
            header(self::LOCATION . baseUrl('login'));
        }
    } //Fin de la función para mostrar el listado de productos

    public function ordenes() {
        if (is_login()) {
            $nombreVista = 'empresa/ordenes/listado';

            $data = array(
                'nombreVista' => $nombreVista,
            );

            if (getSegment(3) == 'listado') {
                return view($nombreVista, $data);
            } else {
                $data = array(
                    'script' => '<!-- Cargar ordenes -->
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    cargar_listado("empresa", "ordenes", "' . baseUrl('empresa/ordenes/listado') . '");
                                });
                            </script>'
                );

                return $this->inicio( $data);
            }
        } //Fin de la validacion

        else {
            header(self::LOCATION . baseUrl('login'));
        }
    } //Fin de la función para mostrar el listado de productos

    public function update($id, $data) {
        $objeto = $this->modelName;

        if (in_array($objeto, $this->objetos)) {
            if (is_login()) {
                if(validar_permiso('empresa', $objeto, 'actualizar')) {
                    if($objeto == 'productos') {
                        $productosService = new ProductosService();

                        return $productosService->update($id, $data);
                    } else if ($objeto == 'clientes') {
                        $clientesService = new ClientesService();

                        return $clientesService->update($id, $data);
                    }

                }

                /*switch ($objeto) {
                    /*case 'productos':
                        $valor_unitario = post('valor_unitario');
                        $impuesto = post('impuesto');

                        $valor_impuesto = $valor_unitario * $impuesto / 100;
                        $valor_total = $valor_unitario + $valor_impuesto;

                        //Colocar con dos decimales
                        $valor_unitario = number_format($valor_unitario, 2, '.', '');
                        $valor_impuesto = number_format($valor_impuesto, 2, '.', '');

                        $data = array(
                            'descripcion' => post('descripcion'),
                            'id_unidad' => post('id_unidad'),
                            'unidad_empaque' => post('unidad_empaque'),
                            'codigo_cabys' => post('codigo_cabys'),
                            'impuesto' => post('impuesto'),
                            'id_categoria' => post('id_categoria'),
                            'valor_unitario' => post('valor_unitario'),
                            'valor_impuesto' => $valor_impuesto,
                            'valor_total' => $valor_total,
                        );

                        if ($model->update($data, $id)) {
                            return json_encode(array('success' => 'Se ha actualizado el producto'));
                        }
                        break;

                    case 'clientes':
                        $data = array(
                            'nombre_comercial' => post('nombre_comercial'),
                            'correo' => post('correo'),
                            'id_ubicacion' => post('id_ubicacion'),
                            'otras_senas' => post('otras_senas'),
                            'telefono' => post('telefono'),
                        );

                        if ($model->update($data, $id)) {
                            return json_encode(array('success' => 'Se ha actualizado el cliente'));
                        }
                        break;
                }*/

                return json_encode(array(
                    'error' => 'Se ha generado un error'
                ));
            } //Fin de la validación de permisos

            return json_encode(array(
                'error' => 'No ha iniciado sesión'
            ));
        } //Fin de la validacion de objeto

        else {
            return json_encode(array(
                'error' => 'Ha ocurrido un error'
            ));
        }
    } //Fin de la función para actualizar un producto

    /**Guardar un cliente en la base de datos */
    public function guardar($objeto = null) {
        if (!is_login()) {
            return json_encode(array(
                'error' => 'No ha iniciado sesion',
            ));
        }

        if (validar_permiso('empresa', $objeto, 'insertar')) {
            if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
                switch ($objeto) {
                    case 'productos':
                        $valor_unitario = post('valor_unitario');
                        $impuesto = post('impuesto');

                        $valor_impuesto = $valor_unitario * $impuesto / 100;
                        $valor_total = $valor_unitario + $valor_impuesto;

                        //Colocar con dos decimales
                        $valor_unitario = number_format($valor_unitario, 2, '.', '');
                        $valor_impuesto = number_format($valor_impuesto, 2, '.', '');
                        $data = array(
                            'descripcion' => post('descripcion'),
                            'id_unidad' => post('id_unidad'),
                            'id_empresa' => getSession('id_empresa'),
                            'unidad_empaque' => post('unidad_empaque'),
                            'id_categoria' => post('id_categoria'),
                            'codigo_venta' => post('codigo_venta'),
                            'codigo_interno' => post('codigo_interno'),
                            'codigo_cabys' => post('codigo_cabys'),
                            'impuesto' => post('impuesto'),
                            'valor_unitario' => post('valor_unitario'),
                            'valor_impuesto' => $valor_impuesto,
                            'valor_total' => $valor_total,
                            'estado' => 1
                        );

                        $model = model('productos');

                        $id = $model->insert($data);

                        if ($id) {
                            return json_encode(array(
                                'success' => 'Se ha guardado el producto correctamente',
                                'id' => $id
                            ));
                        } else {
                            return json_encode(array(
                                'error' => 'Se ha generado un error al guardar el producto'
                            ));
                        }
                        break;

                    case 'clientes':
                        $identificacion = post('identificacion');

                        //Eliminar los guiónes del número de identificación
                        $identificacion = desformatear_cedula($identificacion);

                        $data = array(
                            'identificacion' => $identificacion,
                            'id_tipo_identificacion' => post('id_tipo_identificacion'),
                            'razon' => post('nombre'),
                            'nombre_comercial' => post('nombre_comercial'),
                            'correo' => post('correo'),
                            'id_ubicacion' => post('id_ubicacion'),
                            'otras_senas' => post('otras_senas'),
                            'telefono' => post('telefono'),
                            'cod_pais' => post('cod_pais'),
                            'id_empresa' => getSession('id_empresa'),
                            'estado' => 1
                        );

                        //var_dump($data);

                        $model = model('clientes');

                        $id = $model->insert($data);

                        if ($id) {
                            return json_encode(array(
                                'success' => 'Se ha guardado el cliente correctamente',
                                'id' => $id
                            ));
                        } else {
                            return json_encode(array(
                                'error' => 'Se ha generado un error al guardar el cliente'
                            ));
                        }
                        break;
                }
            } //Fin de la validacion de objeto

            else {
                return json_encode(array(
                    'error' => 'Ha ocurrido un error'
                ));
            }

            return json_encode(array(
                'error' => 'No tiene permisos para realizar esta acción'
            ));
        } //Fin de la validación de permisos
    } //Fin de la función para guardar un objeto

    public function empresas() {
        if(is_login()) {
            $empresa = getEmpresa();

            return view('empresa/cliente/form', $empresa);
        }
    }
}//Fin de la clase
