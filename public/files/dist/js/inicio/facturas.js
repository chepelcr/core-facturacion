let collapse = [];

var linea_activa = null;

var tblDetalles_activa = null;

var factura_activa = '';
var id_factura_activa = 0;

var lineas_activas = 0;

var cantidad_documentos = 0;

/**Ver un documento en pdf */
function verPdf(clave) {
    if (clave != '') {
        $.ajax({
            "url": base + 'documentos/ver_pdf/' + clave,
            "dataType": "html",
        }).done(function (response) {
            //Vaciar los datos del contenedor_pdf
            $('#contenedor_pdf').empty();

            //Agregar el contenido del pdf
            $('#contenedor_pdf').append(response);

            $('#modalVerPdf').modal('show');

        });
    }//Fin del if
}//Fin de la función verPdf

/**Obtener el tipo de cambio del ministerio de hacienda */
function obtener_tipo_cambio(moneda) {
    if (moneda != "") {
        Pace.track(function () {
            $.ajax({
                "url": "https://api.hacienda.go.cr/indicadores/tc/dolar",
                "method": "GET",
                "dataType": "json"
            }).done(function (response) {
                if (moneda == "CRC") {
                    $('#' + factura_activa).find(".tipo_cambio").val(response.compra.valor);
                } else if (moneda == "USD") {
                    $('#' + factura_activa).find(".tipo_cambio").val(response.venta.valor);
                }
            });
        });
    } else {
        $('#' + factura_activa).find(".tipo_cambio").val('');
    }
}

/**Mostrar los descuentos para una linea */
function mostrar_descuentos(numero_linea) {
    if (collapse[numero_linea] == false) {
        collapse[numero_linea] = true;
        $("#descuento" + numero_linea).collapse('show');
    } else {
        collapse[numero_linea] = false;
        $("#descuento" + numero_linea).collapse('hide');
    }
}

/**Eliminar una linea de la facura activa */
function eliminar_linea(boton_eliminar) {
    var linea = $(boton_eliminar).parents(".linea");

    $(linea).remove();

    totales();
}

/**Seleccionar un producto de la base de datos */
function seleccionar_producto(boton_producto) {
    var id_producto = boton_producto.value;

    var linea_producto = $(boton_producto).parents(".producto");

    //Obtener la cantidad 
    var cantidad = $(linea_producto).find(".cantidad").val();

    //Obtener el precio
    var precio = $(linea_producto).find(".precio").val();

    $.ajax({
        "url": base + "empresa/obtener/" + id_producto + "/productos",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            agregar_linea_activa(response, cantidad, precio);

            //Cerrar el modal de busqueda
            $('#modalProductos').modal('hide');
        }
    });
}

/**Agregar un producto en la linea activa o una linea que tenga la misma informacion */
function agregar_linea_activa(producto, cantidad, precio_final) {
    var linea = linea_activa;

    var clone = true;

    //Obtener el codigo del producto
    var codigo = producto.codigo_cabys;

    //Obtener el gnl del producto
    var gnl = producto.codigo_venta;

    //Recorrer las lineas de la factura
    $('#' + factura_activa).find('.linea').each(function () {
        //Si la linea es igual al producto
        if ($(this).find(".codigo").val() == codigo && $(this).find(".gnl").val() == gnl) {
            //Obtener la cantidad de la linea
            var cantidad_linea = $(this).find(".cantidad").val();

            //Sumar la cantidad de la linea activa con la cantidad de la linea
            cantidad = parseInt(cantidad) + parseInt(cantidad_linea);

            linea = $(this);

            clone = false;
        }
    });

    //Si el codigo de la linea no esta vacio
    var codigo_linea = $(linea).find(".codigo").val();

    if (codigo_linea != '' && codigo_linea != 0) {
        clone = false;
    }

    var precio_neto = producto.valor_unitario * cantidad;

    //Agregar informacion a la linea
    linea.find(".impP").val(producto.impuesto);
    linea.find(".descripcion").val(producto.descripcion);
    linea.find(".codigo").val(producto.codigo_cabys);
    linea.find(".gnl").val(producto.codigo_venta);
    linea.find(".cantidad").val(cantidad);
    linea.find(".unidad").val(producto.simbolo_unidad);
    linea.find(".precio").val(producto.valor_unitario);

    if (precio_final != producto.valor_unitario) {
        linea.find(".precio").val(precio_final);

        precio_neto = parseFloat(precio_final) * parseInt(cantidad);
    }

    linea.find(".neto").val(precio_neto);

    //Calcular el subtotal
    var subtotal = parseFloat(precio_neto) - parseFloat(producto.descuento);

    //Calcular el impuesto
    var impuesto = parseFloat(subtotal) * (parseFloat(producto.impuesto) / 100);

    //Calcular el total
    var total = parseFloat(subtotal) + parseFloat(impuesto);

    //Otorgar el valor a los campos en double
    linea.find(".subtotal").val(parseFloat(subtotal).toFixed(2));
    linea.find(".impM").val(parseFloat(impuesto).toFixed(2));
    linea.find(".totalL").val(parseFloat(total).toFixed(2));

    //Si el descuento es mayor a cero
    if (producto.porcentaje_descuento > 0) {
        linea.find(".descP").val(producto.porcentaje_descuento);
        linea.find(".mot").val('Descuento de sistema');
    }

    if (clone) {
        cloneLine();
    }

    totales();

    //Enfoncar el gnl de la ultima linea
    $('#' + factura_activa).find(".gnl").last().focus();
}

function cargar_documentos() {
    Pace.track(function () {
        $.ajax({
            url: base + 'documentos/cargar_documentos',
            dataType: 'html',
            success: function (respuesta) {
                factura_activa = '';
                submodulo_activo = '';

                $('#listado_documentos').empty();

                $('#listado_documentos').append(respuesta);

                crear_data_table('listado');

                //Ocultar todas las facturas
                $('#contenedor_facturas').hide();

                //Desactivar todos los botones de facturas
                $('.btn-factura').removeClass('btn-info').addClass('btn-dark');

                //Activar el boton de documentos
                $('.btn-documentos').addClass('btn-info').removeClass('btn-dark');

                //Expand .card-opciones
                $('.card-opciones').CardWidget('expand');

                //Collapse .card-opciones-documentos
                $('.card-opciones-documentos').CardWidget('collapse');

                //Activar tooltips
                activar_tooltips();

                //Mostrar el contenedor de documentos
                $('#listado_documentos').show();
            }
        });
    });
}

/**Finalizar el documento activo */
function finalizar_documento() {
    //Obtener el valor de .moneda de la factura activa
    var moneda = $('#' + factura_activa).find(".moneda").val();

    obtener_tipo_cambio(moneda);
    
    //Mostrar el .mopdal-finalizar de la factura activa
    $('#' + factura_activa).find('.modal-cierre').modal('show');
}

function cancelar_documento() {
    //Cerrar el modal de cierre de la factura activa
    $('#' + factura_activa).find('.modal-cierre').modal('hide');

    //Esperar un segundo para que se cierre el modal
    setTimeout(function () {
        //Eliminar el contenido de la factura activa
        $('#' + factura_activa).empty();

        //Ocultar el boton de la factura activa
        $('.col-btn-fct-' + id_factura_activa).hide();

        //Cargar documentos
        cargar_documentos();
    }, 1000);
}

/**Ver el contenedor de una factura */
function ver_factura(id_factura) {
    factura = 'card-factura-' + id_factura;

    //Si la factura esta vacia o no existe
    if ($('#' + factura).length == 0 || $('#' + factura).is(':empty')) {
        mensajeAutomatico('Atencion', 'No existe factura con ese ID', 'info');
    }

    else {
        submodulo_activo = 'facturacion';

        factura_activa = factura;

        //Ocultar el contenedor de documentos
        $('#listado_documentos').hide();

        //Mostrar el contenedor de facturas
        $('#contenedor_facturas').show();

        //Ocultar todas las facturas
        $('.card-factura').hide();

        //Collapse .card-opciones
        $('.card-opciones').CardWidget('collapse');

        //Expand .card-opciones-documentos
        $('.card-opciones-documentos').CardWidget('expand');

        //Desactivar boton de documentos
        $('.btn-documentos').removeClass('btn-info').addClass('btn-dark');

        //Desactivar todos los botones de facturas
        $('.btn-factura').removeClass('btn-info').addClass('btn-dark');

        //Ocultar boton .btn-walmart
        $('.btn-walmart').hide();

        //Activar el boton de la factura
        $('#btn_factura_' + id_factura).addClass('btn-info').removeClass('btn-dark');

        id_factura_activa = id_factura;

        $('#' + factura_activa).show();

        //Obtener el id de tipo de documento
        var id_tipo_documento = $('#' + factura_activa).find('.tipo_documento').val();

        $('.btn-referencia').hide();

        //Si el tipo de documento es factura 04, ocultar el boton de clientes
        if (id_tipo_documento == '04') {
            $('.btn-cliente').hide();
        }

        else {
            $('.btn-cliente').show();

            //Obtener la identificacion del modal de la factura activa
            var identificacion = $('#' + factura_activa).find('#identificacion').val();

            if (identificacion != '') {
                obtener_cliente(identificacion);
            }
        }

        if (id_tipo_documento == '02' || id_tipo_documento == '03') {
            //Ocultar el boton de referencias
            $('.btn-referencia').show();
        }

        //Activar tooltip
        activar_tooltips();

        //Poner el cursor en el campo de codigo de barras (gnl) de la factura activa
        $('#' + factura_activa).find(".linea").last().find('.gnl').focus();
    }
}//Fin de la funcion ver_factura

function aumentar_linea() {
    lineas_activas++;

    collapse.push(false);

    linea = $("#" + factura_activa).find(".linea").last();

    $(linea).find(".descB").val(lineas_activas);
    $(linea).find(".eliminarLinea").val(lineas_activas);
    $(linea).find(".btn-buscar-prod").val(lineas_activas);

    $(linea).find(".l_desc").prop('id', ("descuento" + lineas_activas));

    return linea;
}

/**Clonar una linea de la tabla */
function cloneLine() {
    $('#' + factura_activa).find('.tblDetalles').append(
        $('#' + factura_activa).find(".linea").last().clone());

    //Aumentar el numero de lineas
    linea = aumentar_linea();

    $(linea).find("input, select").prop('value', "");

    $(linea).find(".descP").val(0);
    $(linea).find(".mot").val('');
    $(linea).find(".neto").val(0);
    $(linea).find(".descM").val(0);
    $(linea).find(".cantidad").val(0);
    $(linea).find(".subtotal").val(0);
    $(linea).find(".impM").val(0);
    $(linea).find(".totalL").val(0);


    $('#' + factura_activa).find(".eliminarLinea").prop('hidden', false);

    $(linea).find(".eliminarLinea").prop('hidden', true);
}

/**Obtener un contribuyente del ministerio de hacienda */
function obtener_contribuyente() {
    var cedula = $("#" + elemento_activo).find("#identificacion").val();

    if (cedula != '') {
        try {
            $.ajax({
                "url": "https://api.hacienda.go.cr/fe/ae?identificacion=" + cedula,
                "method": "get",
            }).done(function (response) {
                if (response.code != 400) {
                    $("#" + elemento_activo).find("#nombre").val(response.nombre);
                    $("#" + elemento_activo).find("#id_tipo_identificacion").val(response.tipoIdentificacion);
                    $("#" + elemento_activo).find("#cod_pais").val(52);

                    activar_campo_id('id_tipo_identificacion', true);

                    activar_campo_id('cod_pais', true);

                    activar_campo_id('nombre', true);
                }//Fin de validacion de respuesta

                else {
                    mensajeAutomatico('Atencion', 'No se encontro el contribuyente', 'error');
                }
            });
        } catch (error) {
            mensajeAutomatico('Atencion', 'No se ha encontrado el contribuyente', 'info');
        }
    }

    else {
        vaciar_campo_id('nombre');
        vaciar_campo_id('id_tipo_identificacion');
    }
}//Fin de obtener un contribuyente del ministerio de hacienda

/**Agregar un documento electronico al modulo */
function agregar_documento(nombre_documento = '') {
    cantidad_documentos++;

    numero_documento = cantidad_documentos;

    //Solicitud ajax del card de facturacion
    $.ajax({
        url: base + 'documentos/' + nombre_documento + '/' + (cantidad_documentos),
        type: 'GET',
        dataType: 'html',
    }).done(function (data) {
        //Agregar el card de facturacion al la pagina
        $('#contenedor_facturas').append(data);

        //Solicitar el boton de la factura por ajax
        $.ajax({
            url: base + 'documentos/get_boton/' + (cantidad_documentos),
            type: 'GET',
            dataType: 'html',
        }).done(function (data) {
            //Agregar el boton de la factura al la pagina
            $('#nav-facturacion').append(data);

            ver_factura(cantidad_documentos);

            aumentar_linea();
        });
    });
}//Fin de agregar una nueva factura al modulo

/**Obtener todos los clientes de la base de datos */
function buscar_clientes() {
    //Solicitar los clientes por ajax
    $.ajax({
        url: base + 'documentos/get_clientes',
        type: 'GET',
        dataType: 'html',
    }).done(function (data) {
        //Agregar los clientes al modal
        $('#' + factura_activa).find('.card-clientes').show();

        //Ocultar card-busqueda
        $('#' + factura_activa).find('.card-busqueda-clientes').show();

        //Agregar los clientes al modal
        $('#' + factura_activa).find('.card-clientes').empty().append(data);

        //Collapse el .card-cliente de la factura activa
        $('#frm_cliente_' + id_factura_activa).hide();

        //Ocultar el boton de guardar del modal de clientes
        $('#' + factura_activa).find('.btt-grd-clt').hide();

        //Ocultar el boton de editar del modal de clientes
        $('#' + factura_activa).find('.btt-edt-clt').hide();

        //Ocultar el boton de guardar cambios del modal de clientes
        $('#' + factura_activa).find('.btt-grd-clt-cambios').hide();

        //Ocultar el boton de aceptar del modal de clientes
        $('#' + factura_activa).find('.btt-aceptar-clt').hide();

        //Mostrar el boton de seleccionar otro
        $('#' + factura_activa).find('.btt-sct-clt').hide();

        //Mostrar el boton de agregar cliente
        $('#' + factura_activa).find('.btt-add-clt').show();
    });
}

/**Funcion cuando el usuario presiona la opcion para agregar un cliente en el modulo buscar_cliente */
function agregar_cliente() {
    ruta_accion = 'empresa/guardar/clientes';

    //Agregar los clientes al modal
    $('#' + factura_activa).find('.card-clientes').hide();

    //Ocultar card-busqueda
    $('#' + factura_activa).find('.card-busqueda-clientes').hide();

    elemento_activo = 'frm_cliente_' + id_factura_activa;

    //Mostrar el boton de guardar del modal de cliente
    $('#' + factura_activa).find('.btt-grd-clt').show();

    //Ocultar el boton de editar del modal de cliente
    $('#' + factura_activa).find('.btt-edt-clt').hide();

    //Ocultar el boton de aceptar del modal de clientes
    $('#' + factura_activa).find('.btt-aceptar-clt').hide();

    //Ocultar el boton de guardar cambios del modal de cliente
    $('#' + factura_activa).find('.btt-grd-clt-cambios').hide();

    //Mostrar el boton de seleccionar otro
    $('#' + factura_activa).find('.btt-sct-clt').show();

    //Mostrar el boton de agregar cliente
    $('#' + factura_activa).find('.btt-add-clt').hide();

    campos_activos(false, elemento_activo);

    vaciar_campos(elemento_activo);

    //Collapse todos los card del elemento activo
    $('#' + elemento_activo).find('.card').CardWidget('expand');

    //Mostrar el card de clientes
    $('#' + elemento_activo).show();
}


$(document).ready(function () {
    $(document).on('keyup change', '.calcular', function () {
        calcular($(this).parents(".linea"));
    });

    $(".card-factura").on('submit', function (e) {
        e.preventDefault();

        activar_campo_clase('inp-factura', factura_activa, false);

        //Capturar los datos del formulario
        var formData = new FormData(this);

        activar_campo_clase('inp-factura', factura_activa, true);

        Pace.track(function () {
            $.ajax({
                "url": base + "documentos/guardar",
                "method": "post",
                "data": formData,
                "dataType": "json",
                "contentType": false,
                "processData": false,
                "cache": false,
            }).always(function (response) {
                if (!response.error) {
                    Swal.fire({
                        title: 'Atencion',
                        text: response.validar_mensaje,
                        icon: response.estado,
                        showConfirmButton: true,

                        //Texto del boton de confirmacion
                        confirmButtonText: 'Ver PDF',
                        //Accion del boton de confirmacion
                        confirmButtonColor: '#3085d6',
                        //Color del boton de cancelacion
                        cancelButtonColor: '#d33',

                    }).then((result) => {
                        if (result.value) {
                            verPdf(response.clave);
                        }
                    });
                }

                else {
                    mensajeAutomatico('Atencion', response.error, 'error');

                    activar_campo_clase('inp-factura', factura_activa, false);
                }
            });
        });
    });

    //Cuando se enfoca el .gnl
    $(document).on('focus', '.gnl', function () {
        //Seleccionar la .linea mas cercana al .gnl como la linea activa
        linea_activa = $(this).parents(".linea");
    });

    //Cuando se abre el modalProductos
    $('#modalProductos').on('shown.bs.modal', function () {

        //Poner el foco en el input de busqueda
        $('#q_producto').focus();
    });
});

function calcular(linea) {
    var cantidad = linea.find(".cantidad").val();
    var precio = linea.find(".precio").val();
    var impP = linea.find(".impP").val();

    var neto = cantidad * precio;

    var descP = linea.find(".descP").val();
    var descM = parseFloat((neto * descP) / 100).toFixed(2);
    var subtotal = neto - descM;

    var impM = (subtotal * impP) / 100;

    var totalL = subtotal + impM;


    linea.find(".neto").val(parseFloat(neto).toFixed(2));
    linea.find(".descM").val(parseFloat(descM).toFixed(2));
    linea.find(".subtotal").val(parseFloat(subtotal).toFixed(2));
    linea.find(".impM").val(parseFloat(impM).toFixed(2));
    linea.find(".totalL").val(parseFloat(totalL).toFixed(2));

    totales();
}

function totales() {
    neto = 0;
    descuentos = 0;
    subtotal = 0;
    IVA = 0;
    total = 0;

    $('#' + factura_activa).find(".table tbody .linea").each(function (i, item) {
        neto += parseFloat($(item).find(".neto").val());
        descuentos += parseFloat($(item).find(".descM").val());
        subtotal += parseFloat($(item).find(".subtotal").val());
        IVA += parseFloat($(item).find(".impM").val());
        total += parseFloat($(item).find(".totalL").val());
    });

    $('#' + factura_activa).find(".lbl_neto").val(parseFloat(neto).toFixed(2));
    $('#' + factura_activa).find(".lbl_descuentos").val(parseFloat(descuentos).toFixed(2));
    $('#' + factura_activa).find(".lbl_subtotal").val(parseFloat(subtotal).toFixed(2));
    $('#' + factura_activa).find(".lbl_iva").val(parseFloat(IVA).toFixed(2));
    $('#' + factura_activa).find(".lbl_total").val(parseFloat(total).toFixed(2));
}

/**Buscar productos de la base de datos */
function buscar_productos(boton_productos = false) {
    if (boton_productos) {
        //Seleccionar la .linea mas cercana al .gnl como la linea activa
        linea_activa = $(boton_productos).parents(".linea");
    }

    //Obtener el .gnl de la linea activa
    var gnl = linea_activa.find(".gnl").val();

    //Solicitar los productos por ajax
    $.ajax({
        url: base + 'documentos/get_productos',
        type: 'GET',
        dataType: 'html',
    }).done(function (data) {
        //Agregar los productos al modal
        $('#contenedor_busqueda_productos').empty().append(data);

        if(gnl!=''){
            $('#q_productos').val(gnl);

            filtrar_tabla('productos', gnl);
        }

        //Mostrar el modal de busqueda de productos
        $('#modalProductos').modal('show');
    });
}//Fin de buscar_productos

/**Obtener un cliente de la base de datos */
function obtener_cliente(identificacion = '') {
    elemento_activo = 'frm_cliente_' + id_factura_activa;

    //Collapse todos los card del elemento activo
    $('#' + elemento_activo).find('.card').CardWidget('collapse');

    //Solicitar el cliente por ajax
    $.ajax({
        url: base + 'documentos/buscar_cliente/' + identificacion,
        type: 'GET',
        dataType: 'json',
    }).done(function (data) {
        if (!data.error) {
            //Agregar los clientes al modal
            $('#' + factura_activa).find('.card-clientes').hide();

            //Ocultar card-busqueda
            $('#' + factura_activa).find('.card-busqueda-clientes').hide();

            //Llenar el formulario del modal de la factura activa
            $.each(data, function (key, valor) {
                $('#frm_cliente_' + id_factura_activa).find("#" + key).val(valor)
            });

            //Colocar el nombre del cliente en el input .nombre-cliente de la factura activa
            $('#' + factura_activa).find('.nombre-cliente').val(data.nombre);

            //Si el nombre del cliente es igual a Walmart
            if (data.nombre_comercial == 'Walmart') {
                //Mostrar el boton de walmart
                $('.btn-walmart').show();
            }

            else {
                //Ocultar el boton de walmart
                $('.btn-walmart').hide();
            }

            //Ocultar el boton de guardar del modal de cliente
            $('#' + factura_activa).find('.btt-grd-clt').hide();

            //Ocultar el boton de editar del modal de cliente
            $('#' + factura_activa).find('.btt-edt-clt').show();

            //Ocultar el boton de guardar cambios del modal de cliente
            $('#' + factura_activa).find('.btt-grd-clt-cambios').hide();

            //Mostrar el boton de aceptar cliente
            $('#' + factura_activa).find('.btt-aceptar-clt').show();

            //Mostrar el boton de seleccionar otro
            $('#' + factura_activa).find('.btt-sct-clt').show();

            //Mostrar el boton de agregar cliente
            $('#' + factura_activa).find('.btt-add-clt').hide();

            //Llenar la ubuicacion del cliente
            llenarUbicacion(data.cod_provincia, data.cod_canton, data.cod_distrito, data.id_ubicacion);

            campos_activos(true, elemento_activo);

            //Collapse todos los card del elemento activo
            $('#' + elemento_activo).find('.card').CardWidget('expand');

            //Mostrar el card de clientes
            $('#' + elemento_activo).show();
        }
    });
}

/**Editar el cliente del documento activo */
function editar_cliente() {
    //Ocultar el boton de guardar del modal de cliente
    $('#' + factura_activa).find('.btt-grd-clt').hide();

    //Ocultar el boton de editar del modal de cliente
    $('#' + factura_activa).find('.btt-edt-clt').hide();

    //Ocultar el boton de guardar cambios del modal de cliente
    $('#' + factura_activa).find('.btt-grd-clt-cambios').show();

    //Mostrar el boton de aceptar cliente
    $('#' + factura_activa).find('.btt-aceptar-clt').hide();

    //Mostrar el boton de seleccionar otro
    $('#' + factura_activa).find('.btt-sct-clt').show();

    //Mostrar el boton de agregar cliente
    $('#' + factura_activa).find('.btt-add-clt').hide();

    campos_activos(false, elemento_activo);

    activar_campos_cedula(true, elemento_activo);
}

/** Ver el modal del cliente del documento activo*/
function ver_modal_cliente() {
    //Obtener la identificacion del modal de la factura activa
    var identificacion = $('#frm_cliente_' + id_factura_activa).find('#identificacion').val();

    if (identificacion != '') {
        obtener_cliente(identificacion);
    }

    else
        buscar_clientes();

    //Mostrar el modal de busqueda de clientes
    $('#' + factura_activa).find('.modal-clientes').modal('show');
}