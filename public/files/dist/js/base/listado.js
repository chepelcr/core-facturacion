/**Cargar el listado en el contenedor
 * @param {string} modulo Nombre del modulo
 * @param {string} submodulo Nombre del submodulo
 * @param {string} url Url del listado
 */
 function cargar_listado(modulo = '', submodulo = '', url = '') {
    if (modulo != '' && submodulo != '') {
        Pace.track(function () {
            //Solicitar el submodulo
            $.ajax({
                url: url,
                type: 'GET',
            }).done(function (respuesta) {
                //Vaciar el contenedor
                $('#contenedor').empty();

                //Agregar el submodulo a la pagina
                $('#contenedor').append(respuesta);

                crear_data_table('listado');

                cargar_modulo('contenedor');

                activar_modulo_boton(modulo, submodulo);

                //Mostrar el boton para agregar
                $('.agregar_' + modulo + '_' + submodulo).show();

                poner_titulo(modulo, submodulo);
            });
        });
    }//Fin if
}//Fin de cargar_listado

/**Cambiar el titulo de la pagina y agregarla al historial */
function poner_titulo(modulo, submodulo = 'inicio')
{
    modulo_activo = modulo;
    submodulo_activo = submodulo;

    //modulo con primera letra en mayuscula
    var modulo_mayuscula = modulo.charAt(0).toUpperCase() + modulo.slice(1);

    //Submodulo con primera letra en mayuscula
    var submodulo_mayuscula = submodulo.charAt(0).toUpperCase() + submodulo.slice(1);

    //Eliminar guiones bajos de los nombres de los modulos en mayuscula
    modulo_mayuscula = modulo_mayuscula.replace(/_/g, ' ');

    //Eliminar guiones bajos de los nombres de los submodulos en mayuscula
    submodulo_mayuscula = submodulo_mayuscula.replace(/_/g, ' ');

    $('.modulo-pagina').text(modulo_mayuscula);

    $('.submodulo-pagina').text(submodulo_mayuscula);

    if(submodulo_mayuscula != 'Inicio')
    {
        titulo = 'Modas Laura | ' + modulo_mayuscula + ' | ' + submodulo_mayuscula;

        //Agregar pagina al historial
        history.pushState(null, null, base + modulo + '/' + submodulo);
    }

    else
    {
        titulo = 'Modas Laura | ' + modulo_mayuscula;

        //Agregar pagina al historial
        history.pushState(null, null, base + modulo);
    }

    //Cambiar el titulo del navegador web
    $('title').text(titulo);
}//Fin de poner_titulo

/**Transformar una tabla a datatable
 * @param {string} nombre_tabla Nombre de la tabla`
 */
function crear_data_table(nombre_tabla)
{
    nombre_tabla = '#' + nombre_tabla;

    //Validar que el elemento exista y sea una tabla
    if ($(nombre_tabla).length > 0 && $(nombre_tabla).is('table')) 
    {
        //Si ya existe la data table la elimina
        if ($.fn.dataTable.isDataTable(nombre_tabla)) {
            $(nombre_tabla).DataTable().destroy();
        }

        //Crea la data table
        var table = $(nombre_tabla).DataTable( {
            "paging":         true,
            "info":           false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            },

        } );
    }
}//Fin de la funcion