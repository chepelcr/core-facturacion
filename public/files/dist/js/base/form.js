var ruta_accion = "";
var elemento_activo = '';

/**Activar o desactivar un campo por clase */
function activar_campo_clase(clase = '', nombre_elemento = '', estado = false)
{
    if (clase != '') {
        if(nombre_elemento != '')
        {
            $('#' + nombre_elemento).find("." + clase).attr("readonly", estado);
            $('#' + nombre_elemento).find("." + clase).attr("disabled", estado);
        }

        else
        {
            $("." + clase).attr("readonly", estado);
            $("." + clase).attr("disabled", estado);
        }
    }
}//Fin de la funcion

/**Activar un campo por id */
function activar_campo_id(nombre_campo = '', estado = false, nombre_elemento = '')
{
    if (nombre_campo != '') {
        if(nombre_elemento != '')
        {
            $('#' + nombre_elemento).find("#" + nombre_campo).attr("readonly", estado);
            $('#' + nombre_elemento).find("#" + nombre_campo).attr("disabled", estado);
        }

        else
        {
            $("#" + nombre_campo).attr("readonly", estado);
            $("#" + nombre_campo).attr("disabled", estado);
        }
    }
}//Fin de la funcion

/**Activar o desactivar los campos de un formulario */
function campos_activos(estado, elemento = '')
{
    activar_campo_clase('inp', elemento, estado);
}

/**Vaciar los campos de un formulario */
function vaciar_campos(elemento = '')
{
    vaciar_campo_clase('inp', elemento);
}//Fin de la funcion

/**Vaciar un campo por id */
function vaciar_campo_id(nombre_campo = '', nombre_elemento = '')
{
    if (nombre_campo != '') {
        if(nombre_elemento != '')
        {
            $('#' + nombre_elemento).find("#" + nombre_campo).val("");
        }

        else
        {
            $("#" + nombre_campo).val("");
        }
    }
}//Fin de la funcion

/**Vaciar un campo por clase */
function vaciar_campo_clase(clase = '', nombre_elemento = '')
{
    if (clase != '') {
        if(nombre_elemento != '')
        {
            $('#' + nombre_elemento).find("." + clase).val("");
        }

        else
        {
            $("." + clase).val("");
        }
    }
}//Fin de la funcion

/**Activar o desactivar los campos de cedula 
 * y razon social
 * 
 * @param {boolean} estado 
 * @param {string} nombre_elemento 
*/
function activar_campos_cedula(estado, nombre_elemento = '')
{
    activar_campo_id('identificacion', estado, nombre_elemento);
    activar_campo_id('nombre', estado, nombre_elemento);
    activar_campo_id('id_tipo_identificacion', estado, nombre_elemento);
    activar_campo_id('cod_pais', estado, nombre_elemento);
}//Fin de la funcion

/**Abrir el formulario para agregar un objeto */
function agregar(titulo='', nombre_elemento = '', modal = false)
{
    modulo = modulo_activo;
    submodulo = submodulo_activo;

    if((modulo)!='')
    {
        ruta_accion = modulo + '/guardar/';

        if((submodulo)!='')
        {
            ruta_accion = modulo + '/guardar/' + submodulo;
        }//Fin de la validacion

        if((nombre_elemento)!='')
        {
            elemento_activo = nombre_elemento;

            vaciar_campos(nombre_elemento);

            $('#' + nombre_elemento).find(".titulo-form").html(titulo);

            $('#' + nombre_elemento).find('.btt-mod').hide();
            $('#' + nombre_elemento).find('.btt-edt').hide();
            $('#' + nombre_elemento).find('.btt-grd').show();

            campos_activos(false, nombre_elemento);

            //Cerrar todos los card
            $('#' + nombre_elemento).find('.card').CardWidget('collapse');

            //Mostrar el modal
            if(modal)
            {
                $('#' + nombre_elemento).modal('show');
            }

            else
            {
                $('#' + nombre_elemento).show();
            }
        }
    }
}//Fin de la funcion

function enviar_frm(formulario = '', nombre_elemento = '')
{
    if (formulario != '') {
        campos_activos(false, nombre_elemento);

        if(nombre_elemento != ''){
            var formData = new FormData($('#' + nombre_elemento).find('#' + formulario)[0]);
        }

        else
        {
            var formData = new FormData($('#' + formulario)[0]);
        }

        campos_activos(true);

        Pace.track(function () {
            $.ajax({
                "url": base + ruta_accion,
                "method": "post",
                "data": formData,
                "dataType": "json",
                "contentType": false,
                "processData": false,
                "cache": false,
            }).done(function (response) {

                if (!response.error) {
                    Swal.fire({
                        title: 'Atencion',
                        text: 'Operacion exitosa',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then((result) => {
                        cargar_inicio_modulo(modulo_activo);
                })//Fin del mensaje
                }
                else {
                    mensajeAutomatico('Alerta', response.error, 'error');
                } //Fin del else*/
            });
        });
    }
}//Fin de la funcion

/**Lenar un formulario con la informacion enviada */
function llenarFrm(objeto, titulo, nombre_elemento = '', modal = false)
{
    if (objeto) {
        elemento_activo = nombre_elemento;

        $.each(objeto, function(key, valor) {
            $('#' + nombre_elemento).find("#" + key).val(valor)
        });
        
        $('#' + nombre_elemento).find(".titulo-form").html(titulo);

        $('#' + nombre_elemento).find('.btt-mod').show();
        $('#' + nombre_elemento).find('.btt-edt').hide();
        $('#' + nombre_elemento).find('.btt-grd').hide();

        campos_activos(false, nombre_elemento);

        //Cerrar todos los card
        $('#' + nombre_elemento).find('.card').CardWidget('collapse');

        //Si el elemento es un modal
        if(modal)
        {
            $('#' + nombre_elemento).modal('show');
        }

        //Si el elemento es un contenedor
        else
        {
            //Mostrar el elemento
            $('#' + nombre_elemento).show();
        }
    }//Fin de la validacion
}//Fin de la funcion

function verFrm(objeto, titulo, nombre_elemento = '', modal = false)
{
    if (objeto) {
        elemento_activo = nombre_elemento;

        $.each(objeto, function(key, valor) {
            $('#' + nombre_elemento).find("#" + key).val(valor)
        });
        
        $('#' + nombre_elemento).find(".titulo-form").html(titulo);

        $('#' + nombre_elemento).find('.btt-mod').hide();
        $('#' + nombre_elemento).find('.btt-edt').show();
        $('#' + nombre_elemento).find('.btt-grd').hide();

        campos_activos(true, nombre_elemento);

        //Cerrar todos los card
        $('#' + nombre_elemento).find('.card').CardWidget('collapse');

        //Si el elemento es un modal
        if(modal)
        {
            $('#' + nombre_elemento).modal('show');
        }

        //Si el elemento es un contenedor
        else
        {
            //Mostrar el elemento
            $('#' + nombre_elemento).show();
        }
    }//Fin de la validacion
}//Fin de la funcion

/**Editar el contenido de un formulario */
function editar()
{
    $('#' + elemento_activo).find('.btt-edt').hide();
    $('#' + elemento_activo).find('.btt-mod').show();

    campos_activos(false, elemento_activo);
}

$(document).ready(function()
{
    //Cuando se cierra el modal de acciones
    $('#modalAccion').on('hidden.bs.modal', function() {
        vaciar_campos('modalAccion');
        campos_activos(true, 'modalAccion');
    });
});