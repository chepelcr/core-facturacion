var id_articulo = 0;

$(document).ready(function () {
    //Agregar un nuevo producto
    $("#frm").on('submit', function (e) {
        e.preventDefault();

        campos_activos(false);

        //Obtener los datos del formulario
        var formData = new FormData(this);

        campos_activos(true);

        $.ajax({
            "url": base + "empresa/guardar/productos",
            "method": "post",
            "data": formData,
            "dataType": "json",
            "cache": false,
            "contentType": false,
            "processData": false,
        }).done(function (response) {
            if (!response.error) {
                mensajeAutomaticoRecargar("Alerta", "Producto registrado con exito", "success");
            } else {
                mensajeAutomatico("Alerta", response.error, "error");
            }
        });
    });//Fin de agregar unb cliente

    //Modificar un producto
    $(document).on('click', '.btt-mod', function () {
        //Obtener el id del producto
        id_articulo = $('#id_producto').val();

        campos_activos(false);

        $("#codigo_venta").attr("disabled", true);
        $("#codigo_venta").attr("readonly", true);

        //Obtener los datos del formulario
        var formData = new FormData($("#frm")[0]);

        campos_activos(true);

        $.ajax({
            "url": base + "empresa/update/" + id_articulo + "/productos",
            "method": "post",
            "data": formData,
            "dataType": "json",
            "cache": false,
            "contentType": false,
            "processData": false,
        }).done(function (response) {
            if (!response.error) {
                mensajeAutomaticoRecargar("Alerta", "Producto modificado con exito", "success");
            } //Fin del if
            else {
                mensajeAutomatico("Alerta", response.error, "error");
            } //Fin del else
        });
    });//Fin de modificar un usuario

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function () {
        id_articulo = this.value;

        $.ajax({
            "url": base + "empresa/obtener/" + id_articulo + '/productos',
            "dataType": "json",
        }).done(function (response) {
            if (response) {
                llenarFrm(response, 'Modificar producto');

                campos_cabys(false);

                $("#codigo_venta").attr("disabled", true);
                $("#codigo_venta").attr("readonly", true);

                //Desactivar los campos de valor
                $(".valor").attr("disabled", true);
                $(".valor").attr("readonly", true);
            }
        });
    });

    //Cuando se le da click al boton de ver
    $(document).on('click', '#ver', function () {
        id_articulo = this.value;

        $.ajax({
            "url": base + "empresa/obtener/" + id_articulo + '/productos',
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                verFrm(response, 'Informacion del producto');

                campos_cabys(false);

                $("#codigo_venta").attr("disabled", true);
                $("#codigo_venta").attr("readonly", true);
            }

            else
            {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            }
        });
    });

    //Mostrar el modal para agregar un producto
    $(document).on('click', '#btnAgregar', function () {
        $(".titulo-form").html('Agregar producto');

        campos_cabys(false);

        $("#codigo_venta").attr("disabled", false);
        $("#codigo_venta").attr("readonly", false);

        $(".valor").attr("readonly", true);
        $(".valor").attr("disabled", true);
    });

    //Editar un producto
    $(document).on('click', '.btt-edt', function (e) {
        $(".titulo-form").html('Modificar producto');
        campos_cabys(false);

        $("#codigo_venta").attr("disabled", true);
        $("#codigo_venta").attr("readonly", true);

        //Desactivar los campos de valor
        $(".valor").attr("readonly", true);
        $(".valor").attr("disabled", true);
    });//Fin de editar un producto

    //Cuando cambia el valor_unitario
    $(document).on('change', '#valor_unitario', function () {
        var valor_unitario = $("#valor_unitario").val();

        //Activa el campo de impuesto
        $("#impuesto").attr("disabled", false);
        $("#impuesto").attr("readonly", false);

        //Obtener porcentaje de impuesto
        var impuesto = $("#impuesto").val();

        //Desactivar el campo de impuesto
        $("#impuesto").attr("disabled", true);
        $("#impuesto").attr("readonly", true);

        //Calcular el valor del impuesto
        var valor_impuesto = (valor_unitario * impuesto) / 100;
        
        //Calcular el valor total (variable double, dos decimales)
        var valor_total = parseFloat(valor_unitario) + parseFloat(valor_impuesto);

        //Mostrar el valor total
        $("#valor_total").val(valor_total.toFixed(2));

        //Activar los campos de valor
        $(".valor").attr("readonly", false);
        $(".valor").attr("disabled", false);

        //Mostrar el valor impuesto
        $("#valor_impuesto").val(valor_impuesto.toFixed(2));

        //Desactivar los campos de valor
        $(".valor").attr("readonly", true);
        $(".valor").attr("disabled", true);
    });//Fin de cambiar el valor_unitario
});

//Validar si el codigo del producto ya se encuentra registrado
function validarCodigo() {
    //Obtener el codigo del producto a ingresar
    var codigo = $("#codigo_venta").val();

    if (codigo != "") {
        //Consultar en la base de datos
        $.ajax({
            "url": base + "empresa/validar/" + codigo + '/productos',
            "dataType": "json",
        }).done(function (response) {
            if (response) {
                mensajeAutomatico("Alerta", "El codigo ingresado ya se encuentra registrado", "info");

                campos_activos(true);

                $("#codigo_venta").attr("disabled", false);
                $("#codigo_venta").attr("readonly", false);
            }

            else {
                campos_activos(false);

                $("#codigo_venta").attr("disabled", true);
                $("#codigo_venta").attr("readonly", true);

                campos_cabys(false);
            }
        });
    }
}//Fin de la funcion para validar si ya existe el codigo ingresado
