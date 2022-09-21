/**Abrir o cerrar el collapse de una linea de impuesto */
function exonerar_impuesto(boton = null) {
    if (boton != null) {
        linea_activa = boton.closest(".linea");

        var linea = $(boton).closest(".linea_impuesto");

        //Abrir o cerrar el collapse de la linea
        if (linea.find(".collapse_impuesto").hasClass("show")) {
            linea.find(".collapse_impuesto").collapse("hide");
        }
        else {
            linea.find(".collapse_impuesto").collapse("show");
        }
    }//Fin del if
}//Fin del metodo exonerar_impuesto

/**Agregar una linea de impuesto a la linea activa */
function agregar_impuesto(boton) {
    //Obtener la linea activa
    var linea_activa = $(boton).closest(".linea");

    var table_impuestos = linea_activa.find(".tabla_impuestos");

    //Obtener la ultima linea de impuesto
    var linea_impuesto = table_impuestos.find(".linea_impuesto").last();

    //Si el impP de la ultima .linea_impuesto no esta vacio ni es 0
    if (linea_impuesto.find(".impP").val() != "" && linea_impuesto.find(".impP").val() != "0") {

        //Clonar la ultima linea de impuesto
        var nueva_linea = linea_impuesto.clone();

        //Vaciar los campos .impuesto_txt de la nueva linea input
        nueva_linea.find(".impuesto_txt").val("");

        //Colocar NA en los select
        nueva_linea.find("select").val("NA");

        //Vaciar los campos .imp_P
        nueva_linea.find(".imp_P").val(0);

        //Colocar 0 en los campos hide_num
        nueva_linea.find(".hide_num").val(0);

        //Colocar un 0 con formato en .VL
        nueva_linea.find(".VL").val(formato_moneda(0));

        //Mostrar y activar el boton de eliminar .btn-elm
        nueva_linea.find(".btn-elm").attr("hidden", false);
        nueva_linea.find(".tarifas").attr("disabled", true);

        campos_exoneracion(nueva_linea, false);

        nueva_linea.find(".collapse_impuesto").collapse("hide");
        
        //Agregar la nueva linea a la tabla
        table_impuestos.append(nueva_linea);
    }

    else
    {
        notificacion('No se puede agregar un impuesto si el anterior es 0.','', 'warning');
        return;
    }
}

/**Contar la cantidad de lineas de impuestos */
function contar_lineas_impuestos(linea_activa) {
    var table_impuestos = linea_activa.find(".tabla_impuestos");

    var lineas_impuestos = table_impuestos.find(".linea_impuesto");

    return lineas_impuestos.length;
}

/**Activar el porcentaje de una linea de impuesto */
function activar_porcentajes(select) {
    //Obtener la linea de impuesto
    var linea_impuesto = $(select).parents(".linea_impuesto");

    //Si el valor del select es '01' o '07' activar el select de tarifas
    if ($(select).val() == "01" || $(select).val() == "07") {
        linea_impuesto.find(".tarifas").attr("disabled", false);
    } else {
        linea_impuesto.find(".tarifas").attr("disabled", true);
        linea_impuesto.find(".tarifas").val("NA");
    }
}

/**Colocar el porcentaje de impuesto en el campo .impP de la linea de impuesto */
function colocar_tarifa(select = null) {
    if (select != null) {
        //Obtener la linea de impuesto
        var linea_impuesto = $(select).parents(".linea_impuesto");

        //Obtener el data-porcentaje del select
        var porcentaje = $(select).find("option:selected").data("porcentaje");

        //Colocar el porcentaje en el campo .impP
        linea_impuesto.find(".impP").val(porcentaje);
    }
}

/**Eliminar una linea de impuesto */
function eliminar_impuesto(boton = null) {
    if (boton != null) {
        //Obtener la linea de impuesto
        var linea_impuesto = $(boton).parents(".linea_impuesto");

        //Si es la ultima linea de descuento en la tabla_descuentos padre, deshabilitar el boton
        if (linea_impuesto.siblings(".linea_impuesto").length == 0) {
            //Colocar los input y select en empty
            linea_impuesto.find("input select").val("");
        }

        else
        {
            //Eliminar la linea de impuesto
            linea_impuesto.remove();
        }

        var linea_activa = $(boton).closest(".linea");
        calcular(linea_activa);
    }//Fin de validacion del boton
}//Fin del metodo eliminar_impuesto

/**Calcular impuestos de una linea de detalle */
function calcular_impuestos(linea_detalle = null) {
    var impuestoTotal = 0;

    if(linea_detalle!= null)
    {
        linea_detalle = $(linea_detalle);

        var subtotal = linea_detalle.find(".subtotal").val();

        //Obtener la tabla de impuestos
        var tabla_impuestos = linea_detalle.find(".tabla_impuestos");

        //Obtener todas las lineas de impuestos
        var lineas_impuestos = tabla_impuestos.find(".linea_impuesto");

        //Recorrer todas las lineas de impuestos
        lineas_impuestos.each(function (index, linea_impuesto) {
            //Calcular el impuesto de la linea
            var impuesto = calcular_impuesto(linea_impuesto, subtotal);

            //Sumar el impuesto a la variable impuestoTotal
            impuestoTotal += impuesto;
        });
    }

    return impuestoTotal;
}

/**Calcular una linea de impuesto */
function calcular_impuesto(linea_impuesto = null, subtotal = 0) {
    if(linea_impuesto != null)
    {
        linea_impuesto = $(linea_impuesto);
            
        var impP = linea_impuesto.find(".impP").val();

        //console.log("impP: " + impP);

        var impuesto = subtotal * impP / 100;

        //console.log("impuesto: " + impuesto);

        var porcentajeExoneracion = 0;
        
        //Buscar si la linea tiene .porcentaje_exoneracion y si tiene valor
        if (linea_impuesto.find(".porcentaje_exoneracion").length > 0 && linea_impuesto.find(".porcentaje_exoneracion").val() != "") {
            porcentajeExoneracion = linea_impuesto.find(".porcentaje_exoneracion").val();
        }

        //console.log("porcentajeExoneracion: " + porcentajeExoneracion);

        //Si el porcentaje de exoneracion es mayor a 0
        if (porcentajeExoneracion > 0) {
            //Calcular el monto de exoneracion
            var montoExoneracion = subtotal * porcentajeExoneracion / 100;

            //Calcular el impuesto
            impuesto_neto = impuesto - montoExoneracion;
            
            montoExoneracion = Math.round(montoExoneracion);
            linea_impuesto.find(".montEx").val(montoExoneracion);
            linea_impuesto.find(".montExVL").val(formato_moneda(montoExoneracion));

            //console.log("impuesto: " + impuesto);
        }

        else
        {
            impuesto_neto = impuesto;
        }

        linea_impuesto.find(".impuesto").val(impuesto);
        linea_impuesto.find(".impVL").val(formato_moneda(impuesto));

        return impuesto_neto;

    }//Fin de validacion de linea_impuesto
}//Fin del calculo de la linea de impuesto

/**Buscar un numero de exoneracion en el ministerio de hacienda */
function buscar_exoneracion(exoneracion = "", linea_impuesto = null)
{
    //Obtener el tipo de exoneracion
    var tipo_exoneracion = linea_impuesto.find(".tp_exoneracion").val();

    //Si el tipo de exoneracion es por ley especial (03)
    if (tipo_exoneracion == "03" && exoneracion != "") {
        //Colocar 0 a la izquierda de la exoneracion hasta que tenga 8 digitos
        exoneracion = exoneracion.padStart(8, "0");

        url = "https://api.hacienda.go.cr/fe/ex?autorizacion=al-" + exoneracion + "-20";

        Pace.track(function () {
                
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
            }).done(function (data) {
                //Colocar la fechaEmision en formato yyyy-MM-dd (2020-03-30T00:00:00)
                var fechaEmision = data.fechaEmision.split("T")[0];

                //Colocar los datos en los campos correspondientes
                linea_impuesto.find(".fecha_exoneracion").val(fechaEmision);

                linea_impuesto.find(".nombre_institucion").val(data.nombreInstitucion);
                linea_impuesto.find(".porcentaje_exoneracion").val(data.porcentajeExoneracion);

                campos_exoneracion(linea_impuesto);
            }).fail(function (xhr, textStatus, errorThrown) {
                //Activar los campos
                campos_exoneracion(linea_impuesto, false);

                //Mostrar la respuesta
                notificacion("No se ha encontrado la autorizacion solicitada", '', 'warning');
            });
        });
    }

    else
    {
        //Activar los campos
        campos_exoneracion(linea_impuesto, false);
    }
}

/**Activar o desactivar los campos de exoneracion */
function campos_exoneracion(linea_impuesto = null, estado = true)
{
    if(linea_impuesto != null)
    {
        linea_impuesto = $(linea_impuesto);

        //Activar los campos
        linea_impuesto.find(".fecha_exoneracion").attr("readonly", estado);
        linea_impuesto.find(".nombre_institucion").attr("readonly", estado);
        linea_impuesto.find(".porcentaje_exoneracion").attr("readonly", estado);

        linea_impuesto.find(".fecha_exoneracion").attr("disabled", estado);
        linea_impuesto.find(".nombre_institucion").attr("disabled", estado);
        linea_impuesto.find(".porcentaje_exoneracion").attr("disabled", estado);

        //Si el estado es falso
        if (estado == false) {
            //Limpiar los campos
            linea_impuesto.find(".fecha_exoneracion").val("");
            linea_impuesto.find(".nombre_institucion").val("");
            linea_impuesto.find(".porcentaje_exoneracion").val(0);

            linea_impuesto.find(".montEx").val(0);
            linea_impuesto.find(".montExVL").val(formato_moneda(0));

            //Colocar la .linea mas cercana a la .linea_impuesto como activa
            linea_activa = linea_impuesto.parents(".linea");
        }

        //Colocar la .linea mas cercana a la .linea_impuesto como activa
        linea_activa = linea_impuesto.parents(".linea");

        //Calcular la linea activa
        calcular_impuesto(linea_impuesto, linea_activa.find(".subtotal").val());

        calcular(linea_activa);
    }
}

//Document Ready
$(document).ready(function () {
    //Cuando sale del campo .num_exoneracion
    $(document).on("blur", ".num_exoneracion", function () {
        buscar_exoneracion($(this).val(), $(this).parents(".linea_impuesto"));
    });
});