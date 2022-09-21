/**Direccion web de la pagina */
var base = "http://localhost:41062/www/core-facturacion/public/";
//var base = "https://137.184.198.204/";
//var base = "https://164.90.245.14/";

let empresa = 'Modas Laura';

var cambio_compra = 0;
var cambio_venta = 0;

var modulo_activo = 'login';
var submodulo_activo = 'login';

/**Abrir el modal login */
function abrir_login(modo = "login") {
    /**Mostrar el #modal_login */
    $('#modal_login').modal('show');

    elemento_activo = 'modal_login';
    modulo_activo = 'login_perfil';

    if(modo != "login"){

        //Mostrar el card del cambio de contrasenia del elemento_activo
        $('#' + elemento_activo).find('.card-contrasenia').show();

        //Ocultar el card-login del elemento_activo
        $('#' + elemento_activo).find('.card-login').hide();
        
        submodulo_activo = 'contrasenia';
    }//Fin de la validacion

    else
    {
        //Ocultar el card-contrasenia del elemento_activo
        $('#' + elemento_activo).find('.card-contrasenia').hide();
        
        //Mostrar el card-login del elemento_activo
        $('#' + elemento_activo).find('.card-login').show();

        submodulo_activo = 'login';
    }//Fin de la validacion
}//Fin de la funcion

/**Cerrar la sesion del usuario */
function salir() {
    Toast.fire({
        icon: 'info',
        title: 'Cerrando sesión',
        timer: 2000
      }).then((result) => {
        $.ajax({
            url: base + 'login/salir',
            type: 'POST',
            dataType: 'JSON',
            success: function (respuesta) {
                if (respuesta.estado == 1) {
                    location.href = base + 'login';
                }
            }
        });
    });
}//Fin de la funcion salir

//Cuando el documento este listo
$(document).ready(function () {
    //Iniciar sesion en la aplicacin
    $("#frmLogin").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/consultar",
            "method": "post",
            "data": $("#frmLogin").serialize(),
            "dataType": "json"
        }).done(function (response) {
            switch (response.estado) {
                //Si el estado es 1
                case "1":
                    if(modulo_activo == "login_perfil"){
                        abrir_perfil();
                    }//Fin de la validacion
                    else{
                        location.reload();
                    }
                    break;

                //Si la contrasenia ya expiro
                case "2":
                    //Envia mensaje de error al usuario
                    Swal.fire({
                        title: "Atencion",
                        text: response.error,
                        icon: "info",
                        timer: 2000,
                        showConfirmButton: false
                    }).then((result) => {
                        if(modulo_activo == "login_perfil"){
                            mostrar_login('contrasenia');
                        }//Fin de la validacion
                        else{
                            location.reload();
                        }
                    });
                    break;

                default:
                    Swal.fire({
                        title: "Atencion",
                        text: response.error,
                        icon: "warning",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    break;
            }//Fin switch
        }); //Fin del ajax
    }); //Fin del submit

    //Cuando de envia el formulario de cambio de contraseña
    $("#frm_contrasenia").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            "url": base + "seguridad/update/contrasenia",
            "method": "post",
            "data": $("#frm_contrasenia").serialize(),
            "dataType": "json"
        }).done(function (response) {
            if (!response.error) {
                //Envia mesaje de exito
                mensajeAutomaticoRecargar('Atencion', response.success, 'success');
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', response.error, 'error');
            } //Fin del else
        });
    }); //Fin del submit

    $("#frmRecuperar").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/recuperar",
            "method": "post",
            "data": $('#frmRecuperar').serialize(),
            "dataType": "json"
        }).done(function (response) {
            if (response != 0) {
                mensajeAutomaticoRecargar('Atencion', 'Se ha enviado la contraseña a su correo electronico', 'info');
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'El correo electronico no se encuentra registrado', 'error');
            } //Fin del else
        }); //Fin del ajax
    }); //Fin del submit
}); //Fin del documento