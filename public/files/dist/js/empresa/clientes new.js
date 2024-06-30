var cantidad_documentos = 0;

/**Ver un cliente de la base de datos */
function ver_cliente(id_cliente = 0)
{
    if(id_cliente != 0)
    {
        $.ajax({
            "url": base + "empresa/obtener/" + id_cliente + '/clientes',
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                verFrm(response, 'Informacion del cliente', 'modalAccion', true);

                llenarUbicacion(response.cod_provincia, response.cod_canton, response.cod_distrito, response.id_ubicacion);

                campos_activos(true, elemento_activo);
            }

            else
            {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            }
        });
     }
}//Fin de ver un cliente

function modificar_cliente(id_cliente = 0)
{
    if(id_cliente != 0)
    {
        $.ajax({
            "url": base + "empresa/obtener/" + id_cliente + '/clientes',
            "dataType": "json",
        }).done(function (response) {
            if (!response.error) {
                llenarFrm(response, 'Modificar cliente', 'modalAccion', true);

                llenarUbicacion(response.cod_provincia, response.cod_canton, response.cod_distrito, response.id_ubicacion);

                activar_campos_cedula(true, elemento_activo);
            }

            else
            {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
            }
        });
    }
}//Fin de ver un cliente




