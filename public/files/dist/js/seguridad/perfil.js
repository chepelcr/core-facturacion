//Mostrar el modal para agregar o modificar un usuario
$(document).on('click', '#btn_contraseña', function() {
    $(".modal-title").html('Cambiar contraseña');
    
    $('.btt-mod').hide();
    $('.btt-grd').show();
});

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

    mensaje("Atencion", "La contraseña actual no coincide", "error");
});

function verificar_contraseña() {
    var nueva_contraseña = $('#nueva_contraseña').val();
    var contra_nueva_conf = $('#contra_nueva_conf').val();

    if(nueva_contraseña != contra_nueva_conf){
        mensaje("Atencion", "La nueva contraseña no coincide, verifiquela e intente de nuevo.", "error");
    }//Fin de la validacion
}