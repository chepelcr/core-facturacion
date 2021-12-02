/**Transformar una tabla a datatable */
function crear_data_table(nombre_tabla)
{
    $('#'+ nombre_tabla).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
    });
}//Fin de la funcion

$(document).ready(function(){
    crear_data_table('listado');

    //Mostrar el modal para agregar o modificar un objeto
    $(document).on('click', '#btnAgregar', function() {

        $('.btt-mod').hide();
        $('.btt-grd').show();
        
        $('#modalAccion').modal('show');
    });

    //Cuando se cierra el modal de acciones
    $('#modalAccion').on('hidden.bs.modal', function() {
        $(".inp").val("");
    });
});

/**Lenar un formulario con la informacion enviada */
function llenarFrm(objeto)
{
    if (objeto) {
        $.each(objeto, function(key, valor) {
            $("#" + key).val(valor);
        });

        //Activar los campos
        activar_campos(false);

        //Mostrar el modal del usuario
        $('#modalAccion').modal('show');

        $('.btt-mod').show();
        $('.btt-grd').hide();
    }//Fin de la validacion
}//Fin de la funcion

function verFrm(objeto, titulo)
{
    if (objeto) {
        $.each(objeto, function(key, valor) {
            $("#" + key).val(valor)
        });

        //Activar los campos
        activar_campos(true);
        
        $(".titulo-form").html(titulo);

        //Mostrar el modal del usuario
        $('#modalAccion').modal('show');

        $('.btt-mod').hide();
        $('.btt-edt').show();
        $('.btt-grd').hide();
    }//Fin de la validacion
}//Fin de la funcion

/** Activar o desactivar .inp */
function activar_campos(valor)
{
    if (!valor) {
        $(".inp").attr("disabled", false);
        $(".inp").attr("readonly", false);
    } else {
        $(".inp").attr("disabled", true);
        $(".inp").attr("readonly", true);
    }//Fin de la validacion
}//Fin de la funcion