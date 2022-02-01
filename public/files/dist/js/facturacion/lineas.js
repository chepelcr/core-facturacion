let collapse = [];

var linea_activa = null;

var tblDetalles_activa = null;

var lineas_activas = 0;

var lineas_referencia_activas = 1;

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

function eliminar_referencia(boton_eliminar)
{
    var linea = $(boton_eliminar).parents(".linea_referencia");
    
    $(linea).remove();

    //Si solamente queda una linea de referencia
    if($("#" + factura_activa).find(".linea_referencia").length == 1)
    {
        $('#' + factura_activa).find(".eliminarLineaReferencia").attr('disabled', true);
    }
}

/**Agregar un producto en la linea activa o una linea que tenga la misma informacion */
function agregar_linea_activa(producto, cantidad = 1, precio_final = 0) {
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


    //Agregar informacion a la linea
    linea.find(".impP").val(producto.impuesto);
    linea.find(".descripcion").val(producto.descripcion);
    linea.find(".codigo").val(producto.codigo_cabys);
    linea.find(".gnl").val(producto.codigo_venta);
    linea.find(".cantidad").val(cantidad);
    linea.find(".unidad").val(producto.simbolo_unidad);
    linea.find(".precio").val(producto.valor_unitario);

    //Si el precio final es difernte de 0
    if (precio_final != 0 && precio_final != producto.valor_total) {
        //Obtener el monto del impuesto del precio final
        var impuesto = precio_final - precio_final / (producto.impuesto / 100 + 1);

        //Restar el porcentaje de impuesto del precio
        precio_final = precio_final - impuesto;

        //Poner el precio en entero
        precio_final = parseInt(precio_final);

        //Agregar el precio final a la linea
        linea.find(".precio").val(precio_final);
    }

    //Si el descuento es mayor a cero
    if (producto.porcentaje_descuento > 0) {
        linea.find(".descP").val(producto.porcentaje_descuento);
        linea.find(".mot").val('Descuento de sistema');
    }

    calcular(linea);

    if (clone) {
        cloneLine();
    }

    totales();

    //Enfoncar el gnl de la ultima linea
    $('#' + factura_activa).find(".gnl").last().focus();

    //Vaciar el gnl de la ultima linea
    $('#' + factura_activa).find(".gnl").last().val('');
}

/** Aumentar el numero de la ultima linea agregada al modulo */
function aumentar_linea() {
    //Incrementar el numero de lineas activas
    lineas_activas++;

    //Agregar un elemento al collapse de descuentos
    collapse.push(false);

    //Obtener la ultima linea del documento activo
    linea = $("#" + factura_activa).find(".linea").last();

    //Agregar el valor a los botones de acciones
    $(linea).find(".descB").val(lineas_activas);
    $(linea).find(".eliminarLinea").val(lineas_activas);
    $(linea).find(".btn-buscar-prod").val(lineas_activas);

    /**Colocar el id de la linea de descuentos */
    $(linea).find(".l_desc").prop('id', ("descuento" + lineas_activas));

    return linea;
}

/**Clonar una linea de la tabla */
function cloneLine() {
    //Agregar un clone de la ultima linea de la factura, en la tabla de detalles del documento
    $('#' + factura_activa).find('.tblDetalles').append(
        $('#' + factura_activa).find(".linea").last().clone());

    //Aumentar el numero de lineas
    linea = aumentar_linea();

    //Vaciar todos los campos de la linea
    $(linea).find("input, select").prop('value', "");

    /**Colocar los valores de numero en 0 */
    $(linea).find(".descP").val(0);
    $(linea).find(".mot").val('Descuento de sistema');
    $(linea).find(".neto").val(0);
    $(linea).find(".descM").val(0);
    $(linea).find(".cantidad").val(0);
    $(linea).find(".subtotal").val(0);
    $(linea).find(".impM").val(0);
    $(linea).find(".totalL").val(0);

    //Activar el boton de eliminar de todas las lineas
    $('#' + factura_activa).find(".eliminarLinea").prop('hidden', false);

    //Desactivar el boton de eliminar de la linea clonada
    $(linea).find(".eliminarLinea").prop('hidden', true);
}

/**Clonar una linea de referencia */
function cloneReferencia() {
    //Contar la cantidad de lineas de referencia en el documento
    var lineas_referencia_activas = $('#' + factura_activa).find(".linea_referencia").length;

    if(lineas_referencia_activas < 10){
        //Agregar un clone de la ultima linea de la factura, en la tabla de detalles del documento
        $('#' + factura_activa).find('.tblDetalleReferencias').append(
            $('#' + factura_activa).find(".linea_referencia").last().clone());

        //Aumentar el numero de lineas
        linea = aumentar_linea_referencia(lineas_referencia_activas);

        //Vaciar todos los campos de la linea
        $(linea).find("input, select").prop('value', "");

        /**Colocar los valores en '' */
        $(linea).find(".clave").val('');
        $(linea).find(".razon").val('');
        $(linea).find(".fecha").val('');
        $(linea).find(".tipo_documento").val('01');
        $(linea).find(".codigo").val('');

        //Activar el boton de eliminar de todas las lineas
        $('#' + factura_activa).find(".eliminarLineaReferencia").prop('disabled', false);
    }

    else
    {
        mensajeAutomatico('Atencion', 'Solo se pueden agregar 10 referencias', 'info');
    }
}

function aumentar_linea_referencia(linea_actual) {
    //Incrementar el numero de lineas activas
    linea_actual++;

    //Obtener la ultima linea de referencia del documento activo
    linea_referencia = $("#" + factura_activa).find(".linea_referencia").last();

    //Agregar el valor a los botones de acciones
    $(linea_referencia).find(".eliminarLinea").val(linea_actual);

    return linea_referencia;
}


/**Calcular el valor total de una linea */
function calcular(linea) {
    var cantidad = linea.find(".cantidad").val();
    var precio = linea.find(".precio").val();
    var impP = linea.find(".impP").val();
    var descP = linea.find(".descP").val();

    //Calcular el valor neto de la linea
    var neto = parseInt(cantidad) * parseInt(precio);

    //Calcular el valor de descuento de la linea
    var descuento = parseInt(neto) * parseInt(descP) / 100;

    //Calcular el valor de subtotal de la linea
    var subtotal = parseInt(neto) - parseInt(descuento);

    //Calcular el valor de impuesto de la linea
    var impuesto = parseInt(subtotal) * parseInt(impP) / 100;

    //Calcular el valor total de la linea
    var total = parseInt(subtotal) + parseInt(impuesto);

    //Colocar el valor a los campos en enteros redondeados hacia arriba
    linea.find(".neto").val(parseInt(neto));
    linea.find(".descM").val(parseInt(descuento));
    linea.find(".subtotal").val(parseInt(subtotal));
    linea.find(".impM").val(parseInt(impuesto));
    linea.find(".totalL").val(parseInt(total));

    totales();
}

/**Calcular el valor total del documento activo */
function totales() {
    var neto = 0;
    var descuentos = 0;
    var subtotal = 0;
    var IVA = 0;
    var total = 0;

    $('#' + factura_activa).find(".table tbody .linea").each(function (i, item) {
        neto += parseFloat($(item).find(".neto").val());
        descuentos += parseFloat($(item).find(".descM").val());
        subtotal += parseFloat($(item).find(".subtotal").val());
        IVA += parseFloat($(item).find(".impM").val());
        total += parseFloat($(item).find(".totalL").val());
    });

    $('#' + factura_activa).find(".lbl_neto").val(parseInt(neto));
    $('#' + factura_activa).find(".lbl_descuentos").val(parseInt(descuentos));
    $('#' + factura_activa).find(".lbl_subtotal").val(parseInt(subtotal));
    $('#' + factura_activa).find(".lbl_iva").val(parseInt(IVA));
    $('#' + factura_activa).find(".lbl_total").val(parseInt(total));
}

$(document).ready(function () {
    $(document).on('keyup change', '.calcular', function () {
        calcular($(this).parents(".linea"));
    });

    //Cuando se enfoca el .gnl
    $(document).on('focus', '.gnl', function () {
        //Seleccionar la .linea mas cercana al .gnl como la linea activa
        linea_activa = $(this).parents(".linea");
    });
});