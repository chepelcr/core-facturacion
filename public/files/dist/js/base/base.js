/**Direccion web de la pagina */
var base = "http://localhost/modas-laura/Sitema-costos/public/";

var modulo_activo = '';
var submodulo_activo = '';

/**Activar tooltips */
function activar_tooltips() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
}

function ocultar_contenedores()
{
    //Ocultar el contenedor de inicio
    $('#inicio').hide();

    //Ocultar contenedores
    $('.contenedor').hide();

    //Ocultar el contenedor
    $('#contenedor').hide();

    //Ocultar botones de agregar
    $('.agregar').hide();
}

function cargar_modulo(nombre_modulo)
{
    ocultar_contenedores();

    activar_tooltips();

    $('#' + nombre_modulo).show();
}

$(document).ready(function () {
    activar_tooltips();

    $(document).keydown(function (e) {
        if(modulo_activo == 'documentos' && e.ctrlKey)
        {
            //Prevenir que se ejecute la accion por defecto
            e.preventDefault();

            //Si el usuario presiona ctrlLeft+n en el modulo de documentos
            if (e.which == 78) {
                //Agregar una venta rapida
                agregar_documento('tiquete');
            }

            //Si el usuario presiona ctrlLeft+f en el modulo de documentos
            if (e.which == 70) {
                //Agregar una factura
                agregar_documento('factura');
            }

            //Si el usuario presiona un numero en el modulo de documentos
            if (e.which >= 48 && e.which <= 57) {
                //Ver una factura
                ver_factura(e.which - 48);
            }

            //Si el usuario presiona ctrlLeft+d en el modulo de documentos
            if (e.which == 68) {
                cargar_documentos();
            }

            if(submodulo_activo == 'facturacion')
            {
                //Si el usuario presiona ctrlLeft+c en el modulo de documentos
                if (e.which == 67) {
                    //Cancelar una venta
                    cancelar_documento();
                }

                //Si el usuario presiona ctrlLeft+s en el modulo de documentos
                if (e.which == 83) {
                    //Guardar una venta
                    finalizar_documento();
                }

                //Si el usuario preciona ctrlLeft+p
                if (e.which == 80) {
                    buscar_productos();
                }
            }
        }
    });

    //Cuando el mouse entra a .nav-menu
    $('.nav-menu').mouseenter(function () {
        //Cerrar todos los dropdown
        $('.dropdown-menu').hide();

        //Mostrar el dropdown
        $(this).parent().children('.dropdown-menu').show();
    });

    //Cuando el mouse entra a nav-modulo
    $('.nav-modulo').mouseenter(function () {
        //Cerrar todos los dropdown
        $('.dropdown-menu').hide();
    });

    //Cuando el mouse se aleja de .dropdown-menu
    $('.dropdown-menu').mouseleave(function () {
        //Ocultar el dropdown
        $(this).hide();
    });
});