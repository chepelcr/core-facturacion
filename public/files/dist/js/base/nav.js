//Cuando el documento esta listo
$(document).ready(function () {
    cargar_inicio();
});

/**Cargar el modulo de inicio de la aplicacion */
function cargar_inicio() {
    poner_titulo('inicio');
    desactivar_tooltips();

    //Cargar el modulo de inicio
    cargar_modulo('inicio');

    //Activar el boton de inicio
    activar_modulo_boton('inicio');

    elemento_activo = '';
    form_activo = '';

    activar_tooltips();
}

/**Cargar el modulo de inicio de un modulo */
function cargar_inicio_modulo(nombre_modulo) {
    poner_titulo(nombre_modulo);
    desactivar_tooltips();

    if (nombre_modulo == 'documentos') {
        cargar_modulo('contenedor_' + nombre_modulo);
        cargar_documentos();

        elemento_activo = 'contenedor_' + nombre_modulo;
    }

    else {
        activar_modulo_boton(nombre_modulo);

        //Cerrar todos los modal
        $('.modal').modal('hide');

        //Abrir el modal-nombre_modulo
        $('#modal-' + nombre_modulo).modal('show');

        elemento_activo = 'modal-' + nombre_modulo;
    }

    activar_tooltips();
}

/**Activar el boton para un modulo y su submodulo */
function activar_modulo_boton(nombre_modulo, nombre_submodulo = '') {
    $('.nav-button').each(function (i, e) {
        //Desactivar todos los botones
        $(e).removeClass('btn-info');
        $(e).addClass('btn-dark');
    });

    //Desactivar todos los .nav-menu
    $('.nav-menu').each(function (i, e) {
        $(e).removeClass('btn-success');
        $(e).addClass('btn-danger');
    });

    //Desactivar otros botones
    $('.nav-modulo').addClass('btn-secondary').removeClass('btn-warning');

    //Activar el boton del modulo
    $('.nav-' + nombre_modulo).addClass('btn-warning').removeClass('btn-secondary');

    if (nombre_modulo == 'documentos') {
        $('.btn-documentos').addClass('btn-info').removeClass('btn-dark');
    }

    //Si el nombre del submodulo no esta vacio
    if (nombre_submodulo != '') {
        //Activar el boton del submodulo
        $('.btn_' + nombre_modulo + '_' + nombre_submodulo).addClass('btn-info').removeClass('btn-dark');

        //Desactivar otros botones
        $('.nav-item').each(function (i, e) {
            if (!$(e).hasClass('nav-' + nombre_modulo)) {
                $(e).find('.nav-submodulo').addClass('btn-dark').removeClass('btn-info');
            }
        });

        //Desactivar todos los .nav-menu
        $('.nav-menu').each(function (i, e) {
            $(e).removeClass('btn-success');
            $(e).addClass('btn-danger');
        });

        //Activar el .nav-menu
        $('.nav-menu-' + nombre_modulo).addClass('btn-success').removeClass('btn-danger');
    }
}

/**Abrir el modal del perfil de usuario */
function abrir_perfil() {
    campos_activos(true, 'perfil');

    $('.btn-grd-prf').hide();
    $('.btn-cnl-prf').hide();

    //Collapse todos los card
    $('#perfil').find('.card').CardWidget('collapse');

    $('#perfil').modal('show');
}

/**Cerrar la sesion del usuario */
function salir() {
    Swal.fire({
        title: 'Espere',
        text: 'Cerrando sesión',
        icon: 'info',
        timer: 1500,
        showConfirmButton: false,
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
    })//Fin del mensaje
}

