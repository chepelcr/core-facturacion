/**Codigos cabys que se buscan en el ministerio de hacienda */
var cabys = [];

/**Valor del impuesto que se busca en el ministerio de hacienda */
var impuesto = [];

var formato = false;

function buscar_cabys()
{
    if(modulo_activo == 'empresa' && submodulo_activo == 'productos')
    {
        //Ocultar el card-frm del elemento activo
        $("#" + elemento_activo).find(".card-frm").hide();

        //Mostrar el card-cabys del elemento activo
        $("#" + elemento_activo).find(".card-cabys").show();

        //Collapse el card-frm del elemento activo
        $("#" + elemento_activo).find(".card-frm").CardWidget('collapse');

        //Collapse el card-cabys del elemento activo
        $("#" + elemento_activo).find(".card-cabys").CardWidget('collapse');
    }
}

/**Obtener un contribuyente del ministerio de hacienda */
function obtener_contribuyente(identificacion = null) {
    var cedula = identificacion;

    if (cedula != '' && cedula) {
        Pace.track(function () {
            $.ajax({
                "url": "https://api.hacienda.go.cr/fe/ae?identificacion=" + cedula,
                "method": "get",
            }).done(function (response) {
                if (response.code != 400 && response.code != 404) {
                    nombre = response.nombre;

                    //Poner la prmera letra de cada palabra en mayuscula
                    nombre = nombre.replace(/\w\S*/g, function (txt) {
                        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    });

                    cedula_formateada = formatear_cedula(cedula, response.tipoIdentificacion);

                    $("#" + form_activo).find('#identificacion').val(cedula_formateada);

                    $("#" + form_activo).find("#nombre").val(nombre);
                    $("#" + form_activo).find("#id_tipo_identificacion").val(response.tipoIdentificacion);
                    $("#" + form_activo).find("#cod_pais").val(52);

                    activar_campos_contribuyente(true, form_activo);

                    //Desactivar el identificacion
                    $("#" + form_activo).find("#identificacion").attr("disabled", true);
                    $("#" + form_activo).find("#identificacion").attr("readonly", true);

                    //Activar el btn-eliminar
                    $("#" + form_activo).find(".btn-eliminar").attr("disabled", false);
                }//Fin de validacion de respuesta

                if (response.code == 404) {
                    $("#" + form_activo).find("#nombre").val('');
                    $("#" + form_activo).find("#id_tipo_identificacion").val('');
                    $("#" + form_activo).find("#cod_pais").val('');

                    activar_campos_contribuyente(false, form_activo);
                }//Fin de validacion de respuesta
            });
        });
    }

    else {
        $("#" + form_activo).find("#nombre").val('');
        $("#" + form_activo).find("#id_tipo_identificacion").val('');
        $("#" + form_activo).find("#cod_pais").val('');

        activar_campos_contribuyente(false, form_activo);
    }
}//Fin de obtener un contribuyente del ministerio de hacienda

function vaciar_cedula() {
    $("#" + form_activo).find("#identificacion").val('');
    $("#" + form_activo).find("#nombre").val('');
    $("#" + form_activo).find("#id_tipo_identificacion").val('');
    $("#" + form_activo).find("#cod_pais").val('');

    activar_campos_contribuyente(true, form_activo);

    $("#" + form_activo).find("#identificacion").attr("disabled", false);
    $("#" + form_activo).find("#identificacion").attr("readonly", false);

    formato = false;
}

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

/**Buscar codigo cabys en el ministerio de hacienda por nombre */
function nombre_cabys(nombre_producto) {
    if (nombre_producto != '') {
        Pace.track(function () {
            $.ajax({
                "url": 'https://api.hacienda.go.cr/fe/cabys?',
                "data": {
                    'q': nombre_producto
                },
                "dataType": "json",
                "method": "get"
            }).done(function (response) {

                var html = '';
                var i;

                cabys = [];
                impuesto = [];

                for (i = 0; i < response.cabys.length; i++) {
                    html += '<tr>' +
                        '<td>' + response.cabys[i].codigo + '</td>' +
                        '<td>' + response.cabys[i].descripcion + '</td>' +
                        '<td>' + response.cabys[i].impuesto + ' %</td>' +
                        '<td><button data-dismiss="modal" type="button" class="btn btn-warning btn-sm" value="' +
                        i + '" onclick="seleccionar_cabys(' + "'" + i + "'" + ')"><i class="fas fa-check"></i></button></td>'
                    '</tr>';

                    cabys[i] = response.cabys[i].codigo;
                    impuesto[i] = response.cabys[i].impuesto;
                }
                $('#' + elemento_activo).find('#cabys').html(html);

                //Expand el card-cabys
                $('#' + elemento_activo).find('.card-cabys').CardWidget('expand');
            });
        });
    }//Fin del if
}//Fin de la funcion cabys

/**Seleccionar un codigo cabys */
function seleccionar_cabys(valor) {
    var pos = valor;

    campos_cabys(false, form_activo);

    $('#' + elemento_activo).find('#cabys').html('');
    $('#' + elemento_activo).find('#q_cabys').html('');
    $('#' + form_activo).find('#codigo_cabys').val(cabys[pos]);
    $('#' + form_activo).find('#impuesto').val(impuesto[pos]);

    //Ocultar el card-cabys
    $('#' + elemento_activo).find('.card-cabys').hide();

    //Mostrar el card-form
    $('#' + elemento_activo).find('.card-frm').show();

    campos_cabys(true, form_activo);

    //Expand el card-frm
    $('#' + elemento_activo).find('.card-frm').CardWidget('expand');
}

/**Formatear la cedula de un contribuyente */
function formatear_cedula(cedula, tipo_cedula = '01') {
    var cedula_formateada = cedula;

    if (tipo_cedula == "01") {
        //Formato de cedula
        //01-0234-0569

        //Formatear la cedula
        //Obtener el primer digito
        var primer_digito = cedula.substring(0, 1);

        //Obtener el del segundo al quinto digito
        var segundo_digito = cedula.substring(1, 5);

        //Obtener el sexto digito al noveno digito
        var tercer_digito = cedula.substring(5, 9);

        //Rellenar con ceros a la izquierda el primer digito hasta que tenga 2 digitos
        primer_digito = primer_digito.padStart(2, '0');

        //Rellenar con ceros a la izquierda el segundo digito y el tercer digito hasta que sean de 4 digitos
        while (segundo_digito.length < 4) {
            segundo_digito = "0" + segundo_digito;
        }

        while (tercer_digito.length < 4) {
            tercer_digito = "0" + tercer_digito;
        }

        //Unir los 3 digitos con -
        cedula_formateada = primer_digito + "-" + segundo_digito + "-" + tercer_digito;

        formato = true;
    }

    if (tipo_cedula == "02") {
        //Formato de cedula
        //3-123-456700

        //Formatear la cedula
        //Obtener el primer digito
        var primer_digito = cedula.substring(0, 1);

        //Obtener el del segundo al cuarto digito
        var segundo_digito = cedula.substring(1, 4);

        //Obtener todos los restantes digitos
        var tercer_digito = cedula.substring(4, 10);

        //Rellenar con ceros a la izquierda el segundo digito hasta que tenga 3 digitos
        while (segundo_digito.length < 3) {
            segundo_digito = "0" + segundo_digito;
        }

        //Rellenar con ceros a la izquierda el tercer digito hasta que sean de 9 digitos
        while (tercer_digito.length < 6) {
            tercer_digito = "0" + tercer_digito;
        }

        //Unir los 3 digitos con -
        cedula_formateada = primer_digito + "-" + segundo_digito + "-" + tercer_digito;

        formato = true;
    }

    return cedula_formateada;
}//Fin de formatear cedula

function obtener_cabys()
{
    //Obtener el nombre del producto del q_cabys del card-cabys del elemento activo
    var nombre_producto = $('#' + elemento_activo).find('#q_cabys').val();

    //Buscar el codigo cabys por nombre
    nombre_cabys(nombre_producto);
}