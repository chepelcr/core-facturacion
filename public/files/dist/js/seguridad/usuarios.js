var cedula_usuario = "";

$(document).ready(function() {

    //Agregar un nuevo usuario
    $("#frm").on('submit', function(e) {
        e.preventDefault();

        /*$.ajax({
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
        });*/

        mensaje("Atencion", "Usuario agregado correctamente", "success");
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
            "url": base + "seguridad/obtener/" + id_usuario + '/usuarios',
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
        $(".modal-title").html('Modificar usuario');

        $('.btt-mod').show();
        $('.btt-grd').hide();
    });
});

//Verificar numero de cedula del usuario
function verificar() {
    cedula_usuario = $("#cedula_usuario").val();
    
    /*$.ajax({
        "url": base + "usuario/verificar",
        "method": "post",
        "data": {
            "cedula_usuario": cedula_usuario
        },
        "dataType": "json",
    }).done(function(response) {
        
        if (response) {
            mensaje("Alerta", "La cedula indicada ya se encuentra registrada", "info");

            $(".inp").attr("disabled", true);

            $("#cedula_usuario").attr("disabled", false);
            $("#btnGuardar").attr("disabled", true);
        }//Fin del usuario existente

        else
        {
            $('inp').attr("disabled", false);
        }
    });*/

    mensaje("Alerta", "La cedula indicada ya se encuentra registrada", "info");
}//Fin de verificar

function verificar_correo() 
{
    var correo_usuario = $("#correo").val();

    /*$.ajax({
        "url": base + "seguridad/verificar_correo",
        "method": "post",
        "data": {
            "correo": correo
        },
        "dataType": "json",
    }).done(function(response) {
        
        if (response) {
            mensaje("Alerta", "El correo indicado ya se encuentra registrado", "info");

            $(".inp").attr("disabled", true);

            $("#correo_usuario").attr("disabled", false);
            $("#btnGuardar").attr("disabled", true);
        }

        else
        {
            $('inp').attr("disabled", false);
        }
    });*/

    mensaje("Alerta", "El correo ya se encuentra registrado", "info");
}//Fin de verificar_correo

//Mostrar el modal para agregar o modificar un usuario
$(document).on('click', '#btnAgregar', function() {
    $(".modal-title").html('Agregar usuario');
    $("#cedula_usuario").attr("disabled", false);
});