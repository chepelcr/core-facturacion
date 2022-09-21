/**Abrir el modal del perfil de usuario */
function abrir_perfil() {
    //Si el modulo activo es login
    if(modulo_activo == 'login'){
        //Ocultar el modal de login
        $('#modal_login').modal('hide');
    }//Fin del if

    //Collapse todos los card
    $('#perfil').find('.card').CardWidget('collapse');
    
    //Desactivar los campos de perfil
    campos_perfil(false);

    //Expand todos los card
    $('#perfil').find('.card').CardWidget('expand');

    $('#perfil').modal('show');

    elemento_activo = 'perfil';
    modulo_activo = 'perfil';
}//Fin de la funcion

/**Editar el perfil del usuario que ha iniciado sesión */
function editar_perfil(){
    //Si el elemento activo no es el perfil
    if(modulo_activo != 'perfil'){
        //Abrir el perfil
        abrir_perfil();
    }//Fin de la validacion

    form_activo = 'frm_perfil';
    ruta_accion = 'seguridad/update/perfil';

    //Activar los campos del perfil
    campos_perfil(true);
}//Fin de la funcion editar_perfil

/**Activar o desactivar campos del perfil */
function campos_perfil(activar = false){
    if(activar){
        $("#perfil").find('.perfil').attr("readonly", false);
        $("#perfil").find('.perfil').attr("disabled", false);

        //Mostrar el panel_guardar del perfil
        $('#perfil').find('.panel-guardar').show();

        //Ocultar el panel_perfil del perfil
        $('#perfil').find('.panel-perfil').hide();

        activar_campos_cedula(true, 'perfil');
    }//Fin de la validacion

    if(!activar){
        $("#perfil").find('.perfil').attr("readonly", true);
        $("#perfil").find('.perfil').attr("disabled", true);

        //Ocultar el panel-guardar del perfil
        $('#perfil').find('.panel-guardar').hide();

        //Mostrar el panel_perfil del perfil
        $('#perfil').find('.panel-perfil').show();

        activar_campos_cedula(true, 'perfil');
    }//Fin de la validacion

    //Desactivar el campo de id_empresa y id_rol
    $("#perfil").find('.id_empresa').attr("readonly", true);
    $("#perfil").find('.id_empresa').attr("disabled", true);

    $("#perfil").find('.id_rol').attr("readonly", true);
    $("#perfil").find('.id_rol').attr("disabled", true);
}//Fin de la funcion

/**Cancelar la edicion del perfil */
function cancelar_perfil()
{
    //Ocultar el panel_guardar del perfil
    $('#perfil').find('.panel-guardar').hide();

    //Mostrar el panel_perfil del perfil
    $('#perfil').find('.panel-perfil').show();

    //Desactivar los campos del perfil
    campos_perfil(false);
}//Fin de la funcion cancelar_perfil