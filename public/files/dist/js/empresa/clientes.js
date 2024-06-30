var id_cliente = 0;

$(document).ready(function () {
    //Agregar un nuevo cliente
    $("#frm").on('submit', function (e) {
        e.preventDefault();

        activar_campos_cedula(true);

        var formData = new FormData(this);

        campos_activos(true);

        Pace.track(function () {
            $.ajax({
                "url": base + "empresa/guardar/clientes",
                "method": "post",
                "data": formData,
                "dataType": "json",
                "contentType": false,
                "processData": false,
                "cache": false,
            }).done(function (response) {

                if (!response.error) {
                    mensajeAutomaticoRecargar('Atención', 'Cliente guardado correctamente', 'success');
                } //Fin del if
                else {
                    mensajeAutomatico('Alerta', response.error, 'error');
                } //Fin del else*/
            });
        });
    });//Fin de agregar unb cliente

    //Modificar un cliente
    $(document).on('click', '.btt-mod', function (e) {
        e.preventDefault();

        $("#identificacion").attr("disabled", false);

        $.ajax({
            "url": base + "empresa/update/clientes",
            "method": "post",
            "data": $('#frm').serialize(),
            "dataType": "json",
        }).done(function (response) {

            if (!response.error) {
                swal({
                    title: "Atencion",
                    text: "Cliente actualizado correctamente",
                    icon: "success",
                    timer: 2000,
                    buttons: false
                }).then(function () {
                    location.reload();
                });//Fin del mensaje
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });//Fin de modificar un usuario

    //Editar un usuario
    $(document).on('click', '.btt-edt', function (e) {
        activar_campos_cedula(false);
    });//Fin de editar un usuario

    $(document).on('click', '#modificar', function () {
        id_cliente = this.value;

        $.ajax({
            "url": base + "empresa/obtener/" + id_cliente + '/clientes',
            "dataType": "json",
        }).done(function (response) {

            if (response) {
                llenarFrm(response, 'Modificar cliente');

                llenarUbicacion(response.cod_provincia, response.cod_canton, response.cod_distrito, response.id_ubicacion);

                activar_campos_cedula(false);

                //Mostrar el modal del articulo
                $('#modalAccion').modal('show');

                $('.btt-mod').show();
                $('.btt-grd').hide();
            }
        });
    });//Fin de mostrar un cliente

    $(document).on('click', '#btnAgregar', function () {
        $(".titulo-form").html('Agregar cliente');
        desactivar_ubicaciones();
    });
});

