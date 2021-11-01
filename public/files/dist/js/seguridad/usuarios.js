var cedula_usuario = "";

$(document).ready(function() {

    //Agregar un nuevo usuario
    $("#frmUsuario").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "usuario/guardar",
            "method": "post",
            "data": $('#frmUsuario').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response != 0) {
                swal({
                    title: "Atencion",
                    text: "Usuario agregado correctamente",
                    icon: "success",
                    timer: 3000,
                    buttons: false
                }).then(function(){
                    location.reload();    
                });//Fin del mensaje
                
            } //Fin del if
            else {
                mensajeAutomatico('Atencion','Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });

    //Modificar un usuario
    $(document).on('click', '.btt-mod', function(e) {
        e.preventDefault();
        
        $.ajax({
            "url": base + "usuario/update",
            "method": "post",
            "data": $('#frmUsuario').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response != 0) {
                mensajeAutomatico('Atencion', 'Usuario actualizado correctamente', 'success').then(function(){
                    location.reload();
                });
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });//Fin de modificar un usuario

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function() {
        var id_usuario = this.value;

        $.ajax({
            "url": base + "usuario/obtener/" + id_usuario,
            "dataType": "json",
        }).done(function(response) {
            
            if (response) {
                $.each(response, function(key, valor) {
                    $("#" + key).val(valor)
                    $("#" + key).attr("disabled", false);
                });

                $("#cedula_usuario").attr("disbled", true);
            }
        });

        //Mostrar el modal del usuario
        $('#modalAccion').modal('show');

        $('.btt-mod').show();
        $('.btt-grd').hide();
    });
});

//Verificar numero de cedula del usuario
function verificar() {
    cedula_usuario = $("#cedula_usuario").val();
    
    $.ajax({
        "url": base + "usuario/verificar",
        "method": "post",
        "data": {
            "cedula_usuario": cedula_usuario
        },
        "dataType": "json",
    }).done(function(response) {
        
        if (response) {
            mensaje("Alerta", "El usuario ya se encuentra agregado", "info");

            $.each(response, function(key, valor) {
                $("#" + key).val(valor)
                $("#" + key).attr("disabled", true);
            });

            $("#estado").prop("checked", response.estado);

            $("#cedula_usuario").attr("disabled", false);
            $("#btnGuardar").attr("disabled", true);
            $("#btnCabys").attr("disabled", true);
        }//Fin del usuario existente

        else{
            $('inp').val('');
            $("#cedula_usuario").val(cedula_usuario);
        }
    });
}

//Mostrar el modal para agregar o modificar un usuario
$(document).on('click', '#btnAgregar', function() {
    $("#cedula_usuario").attr("disabled", false);
});