function obtener_cantones() {
    var cod_provincia = $(".provincia").val();

    var html = '<option value="">Seleccionar</option>';

    activar_campo_clase("canton", elemento_activo, true);

    $('.distrito').html(html);
    activar_campo_clase("distrito", elemento_activo, true);

    $('.barrio').html(html);
    activar_campo_clase("barrio", elemento_activo, true);

    $.ajax({
        "url": base + 'ubicacion/cantones/' + cod_provincia,
        "dataType": "json",
        "method": "GET"
    }).done(function (response) {
        if (response) {
            for (i = 0; i < response.length; i++) {
                html += '<option value="' + response[i].cod_canton + '">' + response[i].canton + '</option>';
            }

            activar_campo_clase('canton', elemento_activo);
        }

        $('.canton').html(html);
    });
}

/**Obtener todos los distritos de un canton */
function obtener_distritos() {
    var cod_provincia = $('#' + elemento_activo).find(".provincia").val();
    var cod_canton = $('#' + elemento_activo).find(".canton").val();

    var html = '<option value="">Seleccionar</option>';

    activar_campo_clase("distrito", elemento_activo, true);

    $('#' + elemento_activo).find('.barrio').html(html);
    activar_campo_clase("barrio", elemento_activo, true);

    $.ajax({
        "url": base + 'ubicacion/distritos/' + cod_provincia + '/' + cod_canton,
        "dataType": "json",
        "method": "GET"
    }).done(function (response) {
        if (response) {
            for (i = 0; i < response.length; i++) {
                html += '<option value="' + response[i].cod_distrito + '">' + response[i].distrito + '</option>';
            }

            activar_campo_clase('distrito', elemento_activo);
        }

        $('#' + elemento_activo).find('.distrito').html(html);
    });
}

/**Obtener todos los barrios de un distrito */
function obtener_barrios() {
    var cod_provincia = $('#' + elemento_activo).find(".provincia").val();
    var cod_canton = $('#' + elemento_activo).find(".canton").val();
    var cod_distrito = $('#' + elemento_activo).find(".distrito").val();

    var html = '<option value="">Seleccionar</option>';

    activar_campo_clase("barrio", elemento_activo, true);
    
        $.ajax({
            "url": base + 'ubicacion/barrios/' + cod_provincia + '/' + cod_canton + '/' + cod_distrito,
            "dataType": "json",
            "method": "GET"
        }).done(function (response) {
            if (response) {
                for (i = 0; i < response.length; i++) {
                    html += '<option value="' + response[i].id_ubicacion + '">' + response[i].barrio + '</option>';
                }

                activar_campo_clase('barrio', elemento_activo);
            }

            $('#' + elemento_activo).find('.barrio').html(html);
        });
}

/**Llenar la ubicacion */
function llenarUbicacion(cod_provincia, cod_canton, cod_distrito, id_ubicacion) {
    var html = '<option value="">Seleccionar</option>';

    $('#' + elemento_activo).find('.provincia').val(cod_provincia);

    $('#' + elemento_activo).find('.distrito').html(html);
    activar_campo_clase('distrito', elemento_activo, true);

    $('#' + elemento_activo).find('.barrio').html(html);
    activar_campo_clase('barrio', elemento_activo, true);

    var html_canton = html;
    var html_distritos = html;
    var html_barrios = html;

    $.ajax({
        "url": base + 'ubicacion/cantones/' + cod_provincia,
        "dataType": "json",
    }).done(function (cantones) {
        if (cantones) {
            for (i = 0; i < cantones.length; i++) {
                html_canton += '<option value="' + cantones[i].cod_canton + '">' + cantones[i].canton + '</option>';
            }

            $('#' + elemento_activo).find('.canton').html(html_canton);
            //activar_campo_clase('canton', elemento_activo);

            $('#' + elemento_activo).find('.canton').val(cod_canton);

            $.ajax({
                "url": base + 'ubicacion/distritos/' + cod_provincia + '/' + cod_canton,
                "dataType": "json",
            }).done(function (distritos) {
                if (distritos) {
                    for (i = 0; i < distritos.length; i++) {
                        html_distritos += '<option value="' + distritos[i].cod_distrito + '">' + distritos[i].distrito + '</option>';
                    }

                    $('#' + elemento_activo).find('.distrito').html(html_distritos);
                    //activar_campo_clase('distrito', elemento_activo);

                    $('#' + elemento_activo).find('.distrito').val(cod_distrito);

                    $.ajax({
                        "url": base + 'ubicacion/barrios/' + cod_provincia + '/' + cod_canton + '/' + cod_distrito,
                        "dataType": "json",
                    }).done(function (barrios) {
                        if (barrios) {
                            for (i = 0; i < barrios.length; i++) {
                                html_barrios += '<option value="' + barrios[i].id_ubicacion + '">' + barrios[i].barrio + '</option>';
                            }

                            $('#' + elemento_activo).find('.barrio').html(html_barrios);
                            //activar_campo_clase('barrio', elemento_activo);

                            $('#' + elemento_activo).find('.barrio').val(id_ubicacion);
                        }
                    });
                }
            });
        }
    });
}//Fin de la funcion

/**Vaciar los campos de ubicacion */
function vaciar_ubicacion() {
    var html = '<option value="">Seleccionar</option>';

    $('#' + elemento_activo).find('.canton').html(html);
    $('#' + elemento_activo).find('.distrito').html(html);
    $('#' + elemento_activo).find('.barrio').html(html);

    desactivar_ubicaciones();
}

/**Desactivar los campos de ubicacion */
function desactivar_ubicaciones() {
    vaciar_campo_clase('provincia', elemento_activo);

    activar_campo_clase('provincia', elemento_activo, true);
    activar_campo_clase('canton', elemento_activo, true);
    activar_campo_clase('distrito', elemento_activo, true);
}