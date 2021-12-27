/**Buscar codigo cabys en el ministerio de hacienda por nombre */
function nombre_cabys(nombre_producto) {
    if(nombre_producto!='')
    {
        $.ajax({
            "url": 'https://api.hacienda.go.cr/fe/cabys?',
            "data": {
                'q': nombre_producto
            },
            "dataType": "json",
            "method": "get"
        }).done(function (response) {

            var html = '';
            var i;
            for (i = 0; i < response.cabys.length; i++) {
                html += '<tr>' +
                    '<td>' + response.cabys[i].codigo + '</td>' +
                    '<td>' + response.cabys[i].descripcion + '</td>' +
                    '<td>' + response.cabys[i].impuesto + ' %</td>' +
                    '<td><button data-dismiss="modal" type="button" class="btn btn-warning btn-sm seleccionar" value="' +
                    i + '">Seleccionar</button></td>'
                '</tr>';

                cabys[i] = response.cabys[i].codigo;
                impuesto[i] = response.cabys[i].impuesto;
            }
            $('#cabys').html(html);
            
        });
    }//Fin del if
}//Fin de la funcion cabys

/**Activar o desactivar campos del codigo cabys */
function campos_cabys(estado)
{
    if(estado)
    {
        $('#codigo_cabys').attr('readonly', false);
        $('#codigo_cabys').attr('disabled', false);

        $('#impuesto').attr('readonly', false);
        $('#impuesto').attr('disabled', false);
    }

    else
    {
        $('#codigo_cabys').attr('readonly', true);
        $('#codigo_cabys').attr('disabled', true);

        $('#impuesto').attr('readonly', true);
        $('#impuesto').attr('disabled', true);
    }
}

//Cuanod el documento esta listo
$(document).ready(function () {
    //var cabys = [];
    //var impuesto = [];

    //Busqueda de codigo cabys
    $("#frmCabys").on('submit', function(e) {
        e.preventDefault();

        var nombre = $('#q').val();

        nombre_cabys(nombre);
    });

    //Agregar codigo Cabys
    $(document).on("click", ".seleccionar", function () {
        var pos = this.value;

        $("#codigo_cabys").val(cabys[pos]);
        $("#impuesto").val(impuesto[pos]);

       campos_cabys(false);
    });
});