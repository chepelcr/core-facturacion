/**Cargar el modulo de inicio de un modulo */
function cargar_inicio_modulo(nombre_modulo, vista_modulo = '') {
    modulo_activo = nombre_modulo;
    submodulo_activo = '';

    poner_titulo(vista_modulo);

    desactivar_tooltips();

    if (nombre_modulo == 'documentos') {
        cargar_modulo('contenedor_' + nombre_modulo);
        
        cargar_documentos('emitidos');
    }

    else {
        activar_modulo_boton(nombre_modulo);

        cargar_modal('modal-' + nombre_modulo);
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
    elemento_activo = 'inicio';
    form_activo = '';

    modulo_activo = 'inicio';
    submodulo_activo = '';

    poner_titulo('Inicio');
    desactivar_tooltips();

    //Cargar el modulo de inicio
    cargar_modulo('inicio');

    //Activar el boton de inicio
    activar_modulo_boton('inicio');

    activar_tooltips();
}