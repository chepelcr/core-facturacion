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

                    $productosView = $productosService->getProductsListView($_GET);

                    var_dump($productosView);
                    
                    if(isset($productosView->error)) {
                        $data = array(
                            'error' => $productosView->error,
                            'codigo' => $productosView->status
                        );

                        return $this->error($data);
                    } else {
                        return $productosView;
                    }

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

        //var_dump($objeto);

        if (in_array($objeto, $this->objetos)) {
            if (is_login()) {
                if(validar_permiso('empresa', $objeto, 'modificar')) {
                    if($objeto == 'productos') {
                        $productosService = new ProductosService();

                        $result = $productosService->update($id, $data);
                    } elseif ($objeto == 'clientes') {
                        $clientesService = new ClientesService();

                        $result = $clientesService->update($id, $data);
                    }

                } else {
                    $result = array(
                        'error' => 'No tiene permisos para realizar esta acción'
                    );
                }
            } else {
                $result = array(
                    'error' => 'No ha iniciado sesion'
                );
            }
        } else {
            $result = array(
                'error' => 'Acceso no autorizado'
            );
        }

        return json_encode($result);
    } //Fin de la función para actualizar un producto

    /**Guardar un cliente en la base de datos */
    public function guardar($data = null) {
        if (!is_login()) {
            $result = array(
                'error' => 'No ha iniciado sesion',
            );
        }

        $objeto = $this->modelName;

        if (validar_permiso('empresa', $objeto, 'insertar')) {
            if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
                if($objeto == 'productos') {
                    $productosService = new ProductosService();
                    

                    $result = $productosService->create($data);
                    $objeto = 'producto';
                } elseif ($objeto == 'clientes') {
                    $clientesService = new ClientesService();

                    $identification = $data['identification']['number'];
                    $data['identification']['number'] = desformatear_cedula($identification);

                    $result = $clientesService->create($data);
                    $objeto = 'cliente';
                }

                // Si el resultato no contiene error
                if (!isset($result->error)) {
                    $result = array(
                        'success' => "Se ha guardado el $objeto correctamente",
                    );
                } else {
                    $result = array(
                        'error' => "Se ha generado un error al guardar el $objeto"
                    );
                }
            } //Fin de la validacion de objeto

            else {
                $result = array(
                    'error' => 'A ocurrido un error al guardar el objeto'
                );
            }
        } else {
            $result = array(
                'error' => 'No tiene permisos para realizar esta acción'
            );
        }

        return json_encode($result);
    } //Fin de la función para guardar un objeto

    public function empresas() {
        if(is_login()) {
            $empresa = getEmpresa();

            return view('empresa/cliente/form', $empresa);
        }
    }
}//Fin de la clase
