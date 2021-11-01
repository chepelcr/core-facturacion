var cedula_usuario = "";

$(document).ready(function() {

    //Agregar un nuevo usuario
    $("#frmRol").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "rol/guardar",
            "method": "post",
            "data": $('#frmRol').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response != 0) {
                swal({
                    title: "Atencion",
                    text: "Rol agregado correctamente",
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

    //Modificar un rol
    $(document).on('click', '.btt-mod', function(e) {
        e.preventDefault();
        
        $.ajax({
            "url": base + "rol/update",
            "method": "post",
            "data": $('#frmRol').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response != 0) {
                mensajeAutomatico('Atencion', 'Rol actualizado correctamente', 'success').then(function(){
                    location.reload();
                });
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });//Fin de modificar un rol

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function() {
        var id_rol = this.value;

        $.ajax({
            "url": base + "rol/obtener/" + id_rol,
            "dataType": "json",
        }).done(function(response) {
            llenarFrm(response);
        });
    });
});