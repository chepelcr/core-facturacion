var factura_activa = '';
var id_factura_activa = 0;

var cantidad_documentos = 0;

/**Cargar todos los documentos de la empresa */
function cargar_documentos(tipo_reporte = '') {
    if (tipo_reporte == '') {
        var direcion_url = base + 'documentos/cargar_documentos';
    } else {
        var direcion_url = base + 'documentos/cargar_documentos/' + tipo_reporte
    }

    if (tipo_reporte != 'buscar') {
        Pace.track(function () {
            $.ajax({
                url: direcion_url,
                type: 'POST',
                dataType: 'html',
                data: $('#frm_filtro_documentos').serialize(),
                success: function (respuesta) {
                    factura_activa = '';
                    submodulo_activo = '';

                    $('#listado_documentos').empty();

                    $('#listado_documentos').append(respuesta);

                    crear_data_table('documentos');

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

                    //Collapse .card-finalizar
                    $('.card-finalizar').CardWidget('collapse');

                    //Mostrar .cont-reporte
                    $('.cont-reporte').show();

                    contraer_reporte();

                    //Activar tooltips
                    activar_tooltips();

                    //Poner el titulo
                    poner_titulo('documentos');

                    activar_modulo_boton('documentos');

                    //Mostrar el contenedor de documentos
                    $('#listado_documentos').show();
                }
            });
        });
    }
}

/**Descargar un reporte */
function reporte(tipo_reporte) {
    mensajeAutomatico('Generando reporte', 'Espera un momento', 'info');

    //Recorrer todas las lineas de la tabla
    var table = $('#documentos').DataTable();

    let documentos = [];

    //Recorrer las filas que se han filtrado
    table.rows({
        search: 'applied'
    }).every(function () {
        //Si el  $(this.node()).find('.chk-dct') se encuentra checked
        if ($(this.node()).find('.chk-dct').is(':checked')) {
            //Obtener el valor del checkbox
            var id_documento = $(this.node()).find('.chk-dct').val();

            //Agregar el id_documento a los documentos
            documentos.push(id_documento);
        }
    });

    //Enviar una solicitud ajax
    Pace.track(function () {
        //Obtener el archivo zip
        $.ajax({
            url: base + 'documentos/reporte/' + tipo_reporte,
            type: 'POST',
            dataType: 'json',
            data: {
                'documentos': documentos
            },
            success: function (respuesta) {
                if (!respuesta.error) {
                    if(tipo_reporte == 'descarga'){
                        location.href = base + 'documentos/descargar_zip/' + respuesta.nombre_archivo;

                    }else{
                        mensajeAutomatico('Reporte generado', respuesta.success, 'success');
                    }
                } else {
                    mensajeAutomatico('Error', respuesta.error, 'error');
                }
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

/**Eliminar el documento activo en la pantalla */
function cancelar_documento() {
    //Cerrar el modal de cierre de factura
    $('#' + factura_activa).find('.modal-cierre').modal('hide');

    //Esperar un segundo
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
        $('.card-finalizar').CardWidget('expand');

        contraer_reporte();

        //Ocultar .cont-reporte
        $('.cont-reporte').hide();

        //Desactivar boton de documentos
        $('.btn-documentos').removeClass('btn-info').addClass('btn-dark');

        //Desactivar todos los botones de facturas
        $('.btn-factura').removeClass('btn-info').addClass('btn-dark');

        //Ocultar boton .btn-walmart
        $('.col-walmart').hide();

        //Activar el boton de la factura
        $('#btn_factura_' + id_factura).addClass('btn-info').removeClass('btn-dark');

        id_factura_activa = id_factura;

        $('#' + factura_activa).show();

        //Obtener el id de tipo de documento
        var id_tipo_documento = $('#' + factura_activa).find('.tipo_documento').val();

        //Collapse .card-opciones-documentos
        $('.card-opciones-documentos').CardWidget('collapse');

        //Si el tipo de documento es factura 04, ocultar el boton de clientes
        if (id_tipo_documento != '04') {
            //Obtener la identificacion del modal de la factura activa
            var identificacion = $('#' + factura_activa).find('.identificacion-cliente').val();

            if (identificacion != '') {
                obtener_cliente(identificacion);
            }

            if (id_tipo_documento == '02' || id_tipo_documento == '03') {
                //Ocultar el boton de referencias
                $('.col-referencia').show();
            }

            else {
                //Ocultar el boton de referencias
                $('.col-referencia').hide();
            }

            //Mostrar el card-opciones-documentos
            $('.card-opciones-documentos').CardWidget('expand');
        }

        //Poner el titulo
        poner_titulo('documentos', 'facturacion');

        //Activar tooltip
        activar_tooltips();

        //Poner el cursor en el campo de codigo de barras (gnl) de la factura activa
        $('#' + factura_activa).find(".linea").last().find('.gnl').focus();
    }
}//Fin de la funcion ver_factura

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

function guardar_documento() {
    activar_campo_clase('inp-fct', false, factura_activa);

    //Capturar los datos de la factura activa en FormData
    var formData = new FormData($('#' + factura_activa)[0]);

    activar_campo_clase('inp-fct', true, factura_activa);

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
                var mensaje = 'El documento ha sido ' + response.validar_estado + ' por el Ministerio de Hacienda';

                if(response.validar_estado == 'rechazado'){
                    response.estado = 'error';
                }

                if(response.validar_estado == 'procesando'){
                    response.estado = 'warning';
                    mensaje = 'El documento esta siendo procesado por el Ministerio de Hacienda';
                }

                if(response.validar_estado == 'error'){
                    response.estado = 'error';
                    mensaje = 'El documento no ha podido ser ' + response.validar_estado + ' por el Ministerio de Hacienda, debe intetarlo mas tarde';
                }

                Swal.fire({
                    title: 'Documento generado',
                    text: mensaje,
                    icon: response.estado,
                    showConfirmButton: true,

                    //Texto del boton de confirmacion
                    confirmButtonText: 'Ver PDF',
                    //Accion del boton de confirmacion
                    confirmButtonColor: '#3085d6',
                    //Color del boton de cancelacion
                    cancelButtonColor: '#d33',
                    //Icono en el boton de cancelacion
                    cancelButtonText: '<i class="fas fa-times"></i>',

                    //Mostrar el boton de cancelacion
                    showCancelButton: true,

                }).then((result) => {
                    if (result.value) {
                        verPdf(response.clave);
                    }

                    cancelar_documento();
                });
            }

            else {
                Swal.fire({
                    title: 'Atencion',
                    text: response.error,
                    icon: response.estado,
                    showConfirmButton: false,
                    timer: 2000

                }).then((result) => {
                    activar_campo_clase('inp-fct', false, factura_activa);
                });
            }
        });
    });
}

function validar_documento(id = '') {
    if (id != '') {
        Pace.track(function () {
            $.ajax({
                "url": base + "documentos/validar_documento/" + id,
                "method": "get",
                "dataType": "json",
            }).done(function (response) {
                var mensaje = 'El documento ha sido ' + response.validar_estado + ' por el Ministerio de Hacienda';

                if(response.validar_estado == 'rechazado'){
                    response.estado = 'error';
                }

                if(response.validar_estado == 'procesando'){
                    response.estado = 'warning';
                    mensaje = 'El documento esta siendo procesado por el Ministerio de Hacienda';
                }
                Swal.fire({
                    title: 'Atencion',
                    text: mensaje,
                    icon: response.estado,
                    showConfirmButton: true,
                    //Texto del boton de confirmacion
                    confirmButtonText: 'Aceptar',
                });
            });
        });
    }
}

/**Contraer o expandir el card de reporte */
function contraer_reporte(estado = false) {
    //Si estado es true
    if (!estado) {
        //Contraer el card-opciones-reporte
        $('.card-opciones-reporte').CardWidget('collapse');
    }

    //Si estado es false
    else {
        //Expandir el card-opciones-reporte
        $('.card-opciones-reporte').CardWidget('expand');
    }
}

//Activar todos los checkbox de los documentos
function check_documentos(boton) {
    var table = $('#documentos').DataTable();

    //Si el boton esta activo
    if (boton.checked) {
        //Recorrer las filas que se han filtrado
        table.rows({
            search: 'applied'
        }).every(function () {
            //Activar el checkbox
            $(this.node()).find('.chk-dct').prop('checked', true);
        });
    }

    //Si el boton esta desactivado
    else {
        //Desactivar el checkbox de la fila
        table.rows().every(function () {
            $(this.node()).find('.chk-dct').prop('checked', false);
        });
    }

    contraer_reporte(boton.checked);
}//Fin de la función check_documentos

/**Agregar referencias al documento */
function agregar_referencias() {
    //Mostrar el modal de referencias de la factura activa
    $('#' + factura_activa).find('.modal-referencias').modal('show');
}

/**Validar los documentos que se encuentran en proceso */
function validar_documentos() {
    Pace.track(function () {
        $.ajax({
            "url": base + "documentos/validar_documentos",
            "method": "get",
            "dataType": "json",
        }).done(function (response) {
            if (response.error) {
                Swal.fire({
                    title: 'Atencion',
                    text: response.error,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                        salir();
                });
            }
        });
    });
}//Fin de la funcion para validar los documentos

//document ready
$(document).ready(function () {
    //Cuando el usuario presiona un .chk-pg
    $(document).on('change', '.chk-pg', function () {
        //Desactivar los otros checkbox que no son el .chk-pg
        $('.chk-pg').not(this).prop('checked', false);
    });

    //Cuando el usuario envia un form dentro de la factura activa
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();

        //No enviar el form
        return false;
    });

    //Cuando cambia el checked de un .chk-dct
    $(document).on('change', '.chk-dct', function () {
        contraer_reporte($(this).is(':checked'));
    });
});
