var cedula_usuario = "";
var id_usuario = "";

//Habilitar un usuario
function habilitar(id_usuario) {
    $.ajax({
        "url": base + "seguridad/activar/" + id_usuario + "/usuarios",
        "method": "post",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            mensajeAutomaticoRecargar("Alerta", 'Usuario habilitado correctamente', "success");
        } //Fin del if
        else {
            mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
        } //Fin del else
    });
}//Fin de habilitar un usuario

//Deshabilitar un usuario
function deshabilitar(id_usuario) {
    $.ajax({
        "url": base + "seguridad/desactivar/" + id_usuario + "/usuarios",
        "method": "post",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            mensajeAutomaticoRecargar("Alerta", 'Usuario deshabilitado correctamente', "success");
        } //Fin del if
        else {
            mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
        } //Fin del else
    });
}//Fin de deshabilitar un usuario

$(document).ready(function () {
    //Agregar un nuevo usuario
    $("#frm").on('submit', function (e) {
        e.preventDefault();

        Pace.track(function () {
            $.ajax({
                "url": base + "seguridad/guardar/usuarios",
                "method": "post",
                "data": $('#frm').serialize(),
                "dataType": "json",
            }).done(function (response) {

                if (!response.error) {
                    mensajeAutomaticoRecargar("Alerta", 'Usuario agregado correctamente', "success");
                } //Fin del if
                else {
                    mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error.sentencia, 'error');
                } //Fin del else
            });
        });
    });

    //Modificar un usuario
    $(document).on('click', '.btt-mod', function (e) {
        $.ajax({
            "url": base + "seguridad/update/" + id_usuario + "/usuarios",
            "method": "post",
            "data": $('#frm').serialize(),
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                mensajeAutomaticoRecargar("Alerta", 'Usuario modificado correctamente', "success");
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            } //Fin del else
        });
    });//Fin de modificar un usuario

    //Editar un usuario
    $(document).on('click', '.btt-edt', function (e) {
        activar_campos(false);

        $("#cedula_usuario").attr("readonly", true);
        $("#cedula_usuario").attr("disabled", true);
    });//Fin de editar un usuario

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function () {
        id_usuario = this.value;

        $.ajax({
            "url": base + "seguridad/obtener/" + id_usuario + '/usuarios',
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                id_usuario = response.id_usuario;

                llenarFrm(response, 'Editar usuario');

                $("#cedula_usuario").attr("readonly", true);
                $("#cedula_usuario").attr("disabled", true);
            }

            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            }
        });
    });

    //Cuando se le da click al boton de ver
    $(document).on('click', '#ver', function () {
        id_usuario = this.value;

        $.ajax({
            "url": base + "seguridad/obtener/" + id_usuario + '/usuarios',
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                verFrm(response, 'Informacion del usuario');
            }

            else
            {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            }
        });
    });

    //Cuando se le da click al boton de enviar contrasenia
    $(document).on('click', '#enviar', function () {
        id_usuario = this.value;

        Pace.track(function () {
            $.ajax({
                "url": base + "seguridad/enviar_contrasenia/" + id_usuario,
                "dataType": "json",
            }).done(function (response) {
                if (response.estado!='0') {
                    mensajeAutomatico("Alerta", 'Contraseña enviada correctamente', "success");
                } //Fin del if
                else {
                    mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
                } //Fin del else
            });//Fin del ajax
        });
    });

    //Cuando se le da click al boton de desactivar
    $(document).on('click', '#desactivar', function () {
        id_usuario = this.value;

        deshabilitar(id_usuario);
    });

    //Cuando se le da click al boton de activar
    $(document).on('click', '#activar', function () {
        id_usuario = this.value;

        habilitar(id_usuario);
    });

    //Cuando se le da click al boton de agregar
    $(document).on('click', '#btnAgregar', function () {
        $(".titulo-form").html('Agregar usuario');
    });
});

//Verificar numero de cedula del usuario
function verificar() {
    cedula_usuario = $("#cedula_usuario").val();

    if(cedula_usuario!=''){

        $.ajax({
            "url": base + "seguridad/validar/" + cedula_usuario + "/usuarios",
            "dataType": "json",
        }).done(function (response) {
            if (response) {
                mensajeAutomatico("Alerta", "El usuario ya se encuentra agregado", "info");

                activar_campos(false);

                $("#cedula_usuario").attr("readonly", false);
                $("#cedula_usuario").attr("disabled", false);

                $("#btnGuardar").attr("disabled", true);
            }//Fin del usuario existente

            else
            {
                activar_campos(false);
                $("#btnGuardar").attr("disabled", false);
            }
        });
    }//Fin de validacion de cedula
}//Fin de verificar numero de cedula del usuario