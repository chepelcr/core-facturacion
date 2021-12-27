<?php
	/**
	* Controlador para la entidad cliente
	*/

namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\ClientesModel;
use App\Models\CodigosPaisesModel;
use App\Models\EmpresasModel;
use App\Models\InventarioDetalleModel;
use App\Models\ProductosModel;
use App\Models\SucursalesModel;
use App\Models\TipoIdentificacionModel;
use App\Models\TiposDocumentosModel;
use App\Models\UbicacionesModel;
use App\Models\UnidadesMedidaModel;

class Empresa extends BaseController
	{
		protected $isModulo = true;
		
		protected $nombre_modulo = 'empresa';
		
		protected $objetos = ['productos', 'clientes'];

		protected $campos_validacion = array(
			'productos'=>'codigo_venta',
			'sucursales'=>null,
			'clientes'=>'identificacion'
		);

		protected $validacion_login = array(
			'productos'=> true,
			'sucursales'=> true,
			'clientes'=> true
		);

		public function index()
		{
			if(is_login())
			{
				$script = '<script>
					$(document).ready(function(){
						cargar_inicio_modulo("empresa");
					});
				</script>';

				$data = array(
					'script' => $script,
				);

				return $this->inicio($data);
			}//Fin de la validacion

			else
				header('Location: '.baseUrl('login'));
		}//Fin de la funcion index

		/**Retornar la informacion de la empresa */
		public function informacion()
		{
			if(is_login())
			{
				$empresasModel = new EmpresasModel();
				$empresa = $empresasModel->getById(getSession('id_empresa'));

				$script = '<!-- Perfil de empresa -->
					<script type:text/javascript>
						$(document).ready(function() {
							cargar_listado("empresa", "informacion");
						});
					</script>';

				$datos_personales = array(
					'nombre' => $empresa->nombre,
					'identificacion' => $empresa->identificacion,
					'id_tipo_identificacion' => $empresa->id_tipo_identificacion,
					'cod_pais' => $empresa->cod_pais,
					'identificaciones'=> array(
						(object) array(
							'id_tipo_identificacion' => $empresa->id_tipo_identificacion,
							'tipo_identificacion' => $empresa->tipo_identificacion
						)
					),
					'codigos'=> array(
						(object) array(
							'cod_pais' => $empresa->cod_pais,
							'nombre' => $empresa->nombre_pais
						)
					),
				);

				$dataModal = array(
					'nombreForm' => 'empresa/informacion/hacienda',
				);

				$dataView = array(
					'datos_personales' => $datos_personales,
					'dataModal' => $dataModal,
				);

				if(getSegment(3) == 'listado')
				{
					return view('empresa/informacion/perfil', $dataView);
				}

				else
				{
					$data = array(
						'script' => $script
					);
	
					return view('layout', $data);
				}
			}
		}//Fin de la función index

		public function clientes()
		{
			if(is_login())
			{
				if(!validar_permiso('empresa', 'clientes', 'consultar'))
					return json_encode(array(
						'error'=> 'No tiene permisos para consultar clientes'));

				$clientesModel = new ClientesModel();
				$clientes = $clientesModel->getAll();
				
				$nombreVista = 'empresa/cliente/listado';

				$ubicacionesModel = new UbicacionesModel();
                $provincias = $ubicacionesModel->provincias();

				$tiposIdentificacionMoodel = new TipoIdentificacionModel();
				$identificaciones = $tiposIdentificacionMoodel->getAll();

				$codigosPaisesModel = new CodigosPaisesModel();
				$codigos = $codigosPaisesModel->getAll();
				
				$dataProvincias = array(
                    'provincias'=>$provincias
                );

				$datos_personales = array(
					'identificaciones'=>$identificaciones,
					'codigos'=>$codigos
				);

				$nombreForm = 'empresa/cliente/form';

				$dataModal = array(
					'dataForm'=>array(
						'dataProvincias'=>$dataProvincias,
						'datos_personales'=>$datos_personales,
					),
					'nombreForm'=>$nombreForm,
				);

				$dataView = array(
					'clientes'=>$clientes,
					'dataModal'=>$dataModal
				);

				$dataHeader = array(
					'titulo'=>'Modas Laura',
					'objeto'=>'Empresa',
					'pagina'=>'Productos'
				);

				if(getSegment(3) == 'listado')
				{
					return view($nombreVista, $dataView);
				}

				else
				{
					$data = array(
						'nombreVista'=>$nombreVista,
						'dataHeader'=>$dataHeader,
						'dataView'=>$dataView,
						'script'=>'<!-- Cargar clientes -->
							<script type="text/javascript">
								$(document).ready(function() {
									cargar_listado("empresa", "clientes", "'.baseUrl('empresa/clientes/listado').'");
								});
							</script>'
					);
		
					return view('layout', $data);
				}
			}//Fin de la validacion

			else
				return json_encode(array(
					'error'=> 'No ha iniciado sesión',
					'url'=> baseurl('login')));
		}//Fin de la funcion para mostrar el listado de clientes

        public function productos()
		{
			if(is_login())
			{
				if(validar_permiso('empresa', 'productos', 'consultar'))
				{
					$articulosModel = new ProductosModel();
					$articulos = $articulosModel->getAll();

					$categoriasModel = new CategoriasModel();
					$categorias = $categoriasModel->getAll();

					$unidadesMedidaModel = new UnidadesMedidaModel();
					$unidades = $unidadesMedidaModel->getAll();

					$nombreVista = 'empresa/producto/listado';
					$nombreForm = 'empresa/producto/form';

					$dataModal = array(
						'dataForm'=>array(
							'categorias'=>$categorias,
							'unidades'=>$unidades
						),
						'nombreForm'=>$nombreForm,
					);

					$dataView = array(
						'articulos'=>$articulos,
						'dataModal'=>$dataModal
					);

					if(getSegment(3) == 'listado')
					{
						return view($nombreVista, $dataView);
					}

					else
					{
						$script = '<script type="text/javascript" >
							//Cuando el documento esta listo, cargar los productos
							$(document).ready(function(){
								cargar_listado("empresa", "productos", "'.baseUrl('empresa/productos/listado').'");
							});
						</script>';

						$data = array(
							'script'=>$script
						);
			
						return view('layout', $data);
					}
				}

				return json_encode(array(
					'error'=>'No tiene permisos para ver este contenido'
				));
			}//Fin de la validacion

			else
				return json_encode(array(
					'error'=>'No ha iniciado sesión',
					'url'=>baseUrl()
				));
		}//Fin de la funcion para mostrar el listado de productos

		public function ordenes()
		{
			if(is_login())
			{
				$nombreVista = 'empresa/ordenes/listado';

				$data = array(
					'nombreVista'=>$nombreVista,
				);

				if(getSegment(3) == 'listado')
				{
					return view($nombreVista, $data);
				}

				else
				{
					$data = array(
						'nombreVista'=>$nombreVista,
						'script' => '<!-- Cargar ordenes -->
							<script type="text/javascript">
								$(document).ready(function() {
									cargar_listado("empresa", "ordenes", "'.baseUrl('empresa/ordenes/listado').'");
								});
							</script>'
					);
		
					return view('layout', $data);
				}
			}//Fin de la validacion

			else
				header('Location: '.baseUrl());
		}//Fin de la funcion para mostrar el listado de productos

		public function update($id, $objeto = null)
		{
			if(!is_null($objeto)&& in_array($objeto, $this->objetos))
			{
				if(is_login())
				{
					$this->modelName = $objeto;

					switch ($objeto) {
						case 'productos':

							$data = array(
								'descripcion'=>post('descripcion'),
								'id_unidad'=>post('id_unidad'),
								'unidad_empaque'=>post('unidad_empaque'),
								'codigo_cabys'=>post('codigo_cabys'),
								'impuesto'=>post('impuesto'),
								'id_categoria'=>post('id_categoria'),
								'valor_unitario'=>post('valor_unitario'),
								'valor_impuesto'=>post('valor_impuesto'),
								'valor_total'=>post('valor_total'),
							);
						break;

						case 'sucursales':
							
							$data = array(
								'nombre_sucursal'=>post('nombre_sucursal'),
								'id_ubicacion'=>post('id_ubicacion'),
								'otras_senias'=>post('otras_senias'),
							);
						break;

						case 'clientes':
							$data = array(
								'id_tipo_identificacion'=>post('id_tipo_identificacion'),
								'identificacion'=>post('identificacion'),
								'razon'=>post('razon'),
								'nombre_comercial'=>post('nombre_comercial'),
								'correo'=>post('correo'),
								'id_ubicacion'=>post('id_ubicacion'),
								'otras_senas'=>post('otras_senas'),
								'telefono'=>post('telefono'),
								'cod_pais'=>post('cod_pais'),
							);
						break;
					}

					$model = $this->model();

					$id = $model->update($data, $id);

					if($id!=0)
						return json_encode(array(
							'estado'=>1,
						));

					else
						return json_encode(array(
							'error'=>'Se ha generado un error'
						));
				}//Fin de la vaalidacion de permisos

				return json_encode(array(
					'error'=>'No tiene permisos para realizar esta acción'
				));
			}//Fin de la validacion de objeto

			else
				return json_encode(array(
					'error'=>'No se encontro el objeto'
				));
		}//Fin de la funcion para actualizar un producto

		/**Guardar un cliente en la base de datos */
		public function guardar($objeto = null)
		{
			if(!is_login())
			{
				return json_encode(array(
					'error'=>'No ha iniciado sesion',
					'then'=>'location.reload()'
				));
			}

			if(validar_permiso('empresa', $objeto, 'insertar'))
			{
				if(!is_null($objeto)&& in_array($objeto, $this->objetos))
				{
					$this->modelName = $objeto;

					switch ($objeto) {
						case 'productos':
							$data = array(
								'descripcion'=>post('descripcion'),
								'id_unidad'=>post('id_unidad'),
								'id_empresa'=> getSession('id_empresa'),
								'unidad_empaque'=>post('unidad_empaque'),
								'id_categoria'=>post('id_categoria'),
								'codigo_venta'=>post('codigo_venta'),
								'codigo_interno'=>post('codigo_interno'),
								'codigo_cabys'=>post('codigo_cabys'),
								'impuesto'=>post('impuesto'),
								'valor_unitario'=>post('valor_unitario'),
								'valor_impuesto'=>post('valor_impuesto'),
								'valor_total'=>post('valor_total'),
								'estado'=>1
							);
						break;

						case 'clientes':
							var_dump(post());

							$data = array(
								'id_tipo_identificacion'=>post('id_tipo_identificacion'),
								'identificacion'=>post('identificacion'),
								'razon'=>post('nombre'),
								'nombre_comercial'=>post('nombre_comercial'),
								'correo'=>post('correo'),
								'id_ubicacion'=>post('id_ubicacion'),
								'otras_senas'=>post('otras_senas'),
								'telefono'=>post('telefono'),
								'cod_pais'=>post('cod_pais'),
								'estado'=>1
							);
						break;

						default:
							# code...
							break;

						}

					$model = $this->model();

					$id = $model->insert($data);

					if($id!=0)
						return json_encode(array(
							'estado'=>1,
						));

					else
						return json_encode(array(
							'error'=>'Se ha generado un error al guardar el registro'
						));

				}//Fin de la validacion de objeto

				else
					return json_encode(array(
						'error'=>'Ha ocurrido un error inesperado'
					));

				return json_encode(array(
					'error'=>'No tiene permisos para realizar esta acción'
				));
			}//Fin de la vaalidacion de permisos
		}//Fin de la funcion para guardar un objeto
	}//Fin de la clase
?>