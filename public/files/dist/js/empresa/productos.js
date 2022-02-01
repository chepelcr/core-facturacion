$(document).ready(function () {
    //Cuando cambia el valor_unitario
    $(document).on('change keyup', '.valor-producto', function () {
        var valor_unitario = $('#' + form_activo).find("#valor_unitario").val();

        //Activa el campo de impuesto
        activar_campo_id('impuesto', false, form_activo);

        //Obtener porcentaje de impuesto
        var porcentaje_impuesto = $('#' + form_activo).find("#impuesto").val();

        //Desactivar el campo de impuesto
        activar_campo_id('impuesto', true, form_activo);

        //Calcular el valor del impuesto
        var valor_impuesto = (valor_unitario * porcentaje_impuesto) / 100;
        
        //Calcular el valor total (variable double, dos decimales)
        var valor_total = parseFloat(valor_unitario) + parseFloat(valor_impuesto);

        //Mostrar el valor total
        $('#' + form_activo).find("#valor_total").val(valor_total.toFixed(2));

        //Mostrar el valor impuesto
        $('#' + form_activo).find("#valor_impuesto").val(valor_impuesto.toFixed(2));
    });//Fin de cambiar el valor_unitario
});
