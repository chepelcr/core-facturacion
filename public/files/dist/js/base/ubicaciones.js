$(document).ready(function() {
    //Busqueda de cantones
    $(".provincia").on('change', function() {
        var cod_provincia = this.value;

        var html = '<option value="">Seleccionar</option>';

        $(".canton").attr("disabled", true);
        
        $('.distrito').html(html);
        $(".distrito").attr("disabled", true);

        $('.barrio').html(html);
        $(".barrio").attr("disabled", true);

        $.ajax({
            "url": base + 'ubicacion/cantones',
            "data": {
                'cod_provincia': cod_provincia
            },
            "dataType": "json",
            "method": "post"
        }).done(function(response) {
            if(response)
            {
                for (i = 0; i < response.length; i++) {
                    html += '<option value="'+ response[i].cod_canton +'">' + response[i].canton + '</option>';
                }

                $(".canton").attr("disabled", false);
            }

            $('.canton').html(html);
        });
    });

    //Busqueda de distritos
    $(".canton").on('change', function() {
        var cod_provincia = $(".provincia").val();
        var cod_canton = this.value;

        var html = '<option value="">Seleccionar</option>';

        $(".distrito").attr("disabled", true);

        $('.barrio').html(html);
        $(".barrio").attr("disabled", true);

        $.ajax({
            "url": base + 'ubicacion/distritos',
            "data": {
                'cod_provincia': cod_provincia,
                'cod_canton': cod_canton
            },
            "dataType": "json",
            "method": "post"
        }).done(function(response) {
            if(response)
            {
                for (i = 0; i < response.length; i++) {
                    html += '<option value="'+ response[i].cod_distrito +'">' + response[i].distrito + '</option>';
                }

                $(".distrito").attr("disabled", false);
            }

            $('.distrito').html(html);
        });
    });

    //Busqueda de barrios
    $(".distrito").on('change', function() {
        var cod_provincia = $(".provincia").val();
        var cod_canton = $(".canton").val();
        var cod_distrito = this.value;

        $(".barrio").attr("disabled", true);

        var html = '<option value="">Seleccionar</option>';

        $.ajax({
            "url": base + 'ubicacion/barrios',
            "data": {
                'cod_provincia': cod_provincia,
                'cod_canton': cod_canton,
                'cod_distrito': cod_distrito,
            },
            "dataType": "json",
            "method": "post"
        }).done(function(response) {
            if(response)
            {
                for (i = 0; i < response.length; i++) {
                    html += '<option value="'+ response[i].id_ubicacion +'">' + response[i].barrio + '</option>';
                }

                $(".barrio").attr("disabled", false);
            }
            $('.barrio').html(html);
        });
    });
});

function llenarUbicacion(cod_provincia, cod_canton, cod_distrito, id_ubicacion)
    {
        var html = '<option value="">Seleccionar</option>';

        $('.provincia').val(cod_provincia);

        $(".canton").attr("disabled", true);
        
        $('.distrito').html(html);
        $(".distrito").attr("disabled", true);

        $('.barrio').html(html);
        $(".barrio").attr("disabled", true);

        var html_canton = html;
        var html_distritos = html;
        var html_barrios = html;

        $.ajax({
            "url": base + 'ubicacion/cantones',
            "data": {
                'cod_provincia': cod_provincia
            },
            "dataType": "json",
            "method": "post"
        }).done(function(cantones) {
            if(cantones)
            {
                for (i = 0; i < cantones.length; i++) {
                    html_canton += '<option value="'+ cantones[i].cod_canton +'">' + cantones[i].canton + '</option>';
                }

                $('.canton').html(html_canton);
                $(".canton").attr("disabled", false);
                $('.canton').val(cod_canton);
                
                $.ajax({
                    "url": base + 'ubicacion/distritos',
                    "data": {
                        'cod_provincia': cod_provincia,
                        'cod_canton': cod_canton
                    },
                    "dataType": "json",
                    "method": "post"
                }).done(function(distritos) {
                    if(distritos)
                    {
                        for (i = 0; i < distritos.length; i++) {
                            html_distritos += '<option value="'+ distritos[i].cod_distrito +'">' + distritos[i].distrito + '</option>';
                        }
        
                        $('.distrito').html(html_distritos);
                        $(".distrito").attr("disabled", false);
                        $('.distrito').val(cod_distrito);

                        $.ajax({
                            "url": base + 'ubicacion/barrios',
                            "data": {
                                'cod_provincia': cod_provincia,
                                'cod_canton': cod_canton,
                                'cod_distrito': cod_distrito,
                            },
                            "dataType": "json",
                            "method": "post"
                        }).done(function(barrios) {
                            if(barrios)
                            {
                                for (i = 0; i < barrios.length; i++) {
                                    html_barrios += '<option value="'+ barrios[i].id_ubicacion +'">' + barrios[i].barrio + '</option>';
                                }
                
                                $('.barrio').html(html_barrios);
                                $(".barrio").attr("disabled", false);
                                $('.barrio').val(id_ubicacion);
                            }
                        });
                    }
                });
            }
        });
    }//Fin de la funciion