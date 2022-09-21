/**Obtener un contribuyente del ministerio de hacienda */
function obtener_contribuyente(identificacion = null) {
    var cedula = identificacion;

    if (cedula != '' && cedula) {
        //Si la cedula es menor a 9 digitos
        if (cedula.length < 9) {
            mensajeAutomatico('Atencion', "La identificacion indicada es muy corta", 'error');
            return false;
        }

        Pace.track(function () {
            var nombre = '';
            /*$.ajax({
                "url": "https://api.hacienda.go.cr/fe/ae?identificacion=" + cedula,
                "method": "get",
            }).done(function (response) {
                if (response.code != 400 && response.code != 404) {*/

            var url_cedulas = "https://apis.gometa.org/cedulas/" + cedula;

            $.ajax({
                "url": url_cedulas,
                "method": "get",
            }).done(function (response) {
                if(response.error)
                {
                    mensajeAutomatico('Atencion', "Ha ocurrido un error en la consulta", 'error');
                    return false;
                }

                else
                {
                    //Si hay elementos en el campo results
                    if (response.results.length > 0) {
                        //Obtener el primer elemento del array
                        var elemento = response.results[0];

                        //Asignar los valores al formulario
                        nombre = elemento.fullname;
                        
                        //Poner la prmera letra de cada palabra en mayuscula
                        nombre = nombre.replace(/\w\S*/g, function (txt) {
                            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                        });

                        cedula_formateada = formatear_cedula(cedula, response.tipoIdentificacion);

                        //Si el tipo de identificacion es 02
                        if (response.tipoIdentificacion == '02') {
                            //Si el nombre contiene Sociedad De Responsabilidad Limitada, Sociedad Anonima, ETC; cambiar por "S.R.L.", "S.A.", etc
                            if (nombre.includes("Sociedad De Responsabilidad Limitada")) {
                                nombre = nombre.replace("Sociedad De Responsabilidad Limitada", "S.R.L.");
                            }
                            if (nombre.includes("Sociedad Anonima")) {
                                nombre = nombre.replace("Sociedad Anonima", "S.A.");
                            }
                        }

                        $("#" + form_activo).find('.identificacion').val(cedula_formateada);

                        $("#" + form_activo).find(".nombre").val(nombre);
                        $("#" + form_activo).find(".id_tipo_identificacion").val(response.tipoIdentificacion);
                        $("#" + form_activo).find(".cod_pais").val(52);

                        activar_campos_contribuyente(true, form_activo);

                        //Desactivar el identificacion
                        $("#" + form_activo).find(".identificacion").attr("disabled", true);
                        $("#" + form_activo).find(".identificacion").attr("readonly", true);

                        //Activar el btn-eliminar
                        $("#" + form_activo).find(".btn-eliminar").attr("disabled", false);

                        //Si el submodulo activo es usuarios, crear el nombre de usuario
                        if (submodulo_activo == 'usuarios') {
                            //Si el tipo de identificacion es 01
                            if (response.tipoIdentificacion == '01') {
                            {
                                //Obtener la primera letra del nombre
                                var nombre_usuario = nombre.substring(0, 1);

                                //Poner el apellido solo con la primera letra en mayuscula
                                var apellido = elemento.lastname1;

                                apellido = apellido.replace(/\w\S*/g, function (txt) {
                                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                                });

                                nombre_usuario = nombre_usuario + apellido;
                            }

                            //Si el tipo de identificacion es 02
                            } else if (response.tipoIdentificacion == '02') {
                                //Recorrer las palabras del nombre
                                var nombre_usuario = '';

                                var nombre_array = nombre.split(' ');

                                //Recorrer el array
                                $.each(nombre_array, function (index, value) {
                                    //Obtener la primera letra de cada palabra que tenga mas de 3 letras
                                    if (value.length > 3) {
                                        //Validar que la palabra no sea: de, del, de la, del, SOCIEDAD, RESPONSABILIDAD, LIMITADA, anonima, S.A, S.A.S, S.R.L, S.R.L.
                                        if (value.toLowerCase() != 'de' && value.toLowerCase() != 'del' && value.toLowerCase() != 'de la' && value.toLowerCase() != 'del' && value.toLowerCase() != 'sociedad' && value.toLowerCase() != 'responsabilidad' && value.toLowerCase() != 'limitada' && value.toLowerCase() != 'anonima' && value.toLowerCase() != 's.a' && value.toLowerCase() != 's.a.s' && value.toLowerCase() != 's.r.l' && value.toLowerCase() != 's.r.l.') {
                                            nombre_usuario = nombre_usuario + value.substring(0, 1);
                                        }
                                    }
                                });
                            }

                            
                            //Asignar el nombre de usuario
                            $("#" + form_activo).find(".nombre_usuario").val(nombre_usuario);

                            //Desactivar el nombre de usuario
                            $("#" + form_activo).find(".nombre_usuario").attr("disabled", true);
                            $("#" + form_activo).find(".nombre_usuario").attr("readonly", true);
                        }//Fin de validacion de submodulo activo

                        return true;
                    }//Fin de validacion de resultados

                    //Si no hay elementos en el campo results, buscar en la base de datos del ministerio de hacienda
                    else
                    {
                        $.ajax({
                            "url": "https://api.hacienda.go.cr/fe/ae?identificacion=" + cedula,
                            "method": "get",
                        }).done(function (response) {
                            if (response.code != 400) {
                                nombre = response.nombre;

                                //Poner la prmera letra de cada palabra en mayuscula
                                nombre = nombre.replace(/\w\S*/g, function (txt) {
                                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                                });

                                cedula_formateada = formatear_cedula(cedula, response.tipoIdentificacion);

                                $("#" + form_activo).find('.identificacion').val(cedula_formateada);

                                $("#" + form_activo).find(".nombre").val(nombre);
                                $("#" + form_activo).find(".id_tipo_identificacion").val(response.tipoIdentificacion);
                                $("#" + form_activo).find(".cod_pais").val(52);

                                activar_campos_contribuyente(true, form_activo);

                                //Desactivar el identificacion
                                $("#" + form_activo).find(".identificacion").attr("disabled", true);
                                $("#" + form_activo).find(".identificacion").attr("readonly", true);

                                //Activar el btn-eliminar
                                $("#" + form_activo).find(".btn-eliminar").attr("disabled", false);

                                return true;
                            }
                        }).fail(function (xhr, textStatus, errorThrown) {
                            //Mostrar la respuesta
                            mensajeAutomatico('Atencion', "Debe ingresar la información manualmente", 'info');
                        });

                        $("#" + form_activo).find(".nombre").val('');
                        $("#" + form_activo).find(".id_tipo_identificacion").val('');
                        $("#" + form_activo).find(".cod_pais").val('');

                        activar_campos_contribuyente(false, form_activo);
                    }
                }
            });
        });
    }//Fin if cedula
}//Fin de obtener un contribuyente del ministerio de hacienda