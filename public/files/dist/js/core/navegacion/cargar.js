/**Cargar el modulo de inicio de un modulo */
function cargar_inicio_modulo(nombre_modulo) {
    poner_titulo(nombre_modulo);
    desactivar_tooltips();

    if (nombre_modulo == 'documentos') {
        cargar_modulo('contenedor_' + nombre_modulo);
        
        cargar_documentos('emitidos');

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

/**Preloader */
function loading(function_cargar = function () { }) {
    var num = 0;
    $('.content-wrapper').hide();
    $('.main-header').hide();
    $('.main-footer').hide();

    for (i = 0; i <= 100; i++) {
        setTimeout(function () {
            if (num == 100) {
                $('.loader').hide();
                
                $('.main-header').show();
                $('.main-footer').show();
                $('.content-wrapper').show();

                obtener_tipo_cambio();

                //Si la funcion tiene contenido
                if (function_cargar != '') {
                    function_cargar();
                }
                
            }
            num++;
        }, i * 40);
    };
}

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