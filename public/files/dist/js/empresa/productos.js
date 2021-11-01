$(document).ready(function() {
    //Busqueda de codigo cabys
    $("#frmCabys").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": 'https://api.hacienda.go.cr/fe/cabys?',
            "data": {
                'q': $('#q').val()
            },
            "dataType": "json",
            "method": "get"
        }).done(function(response) {

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
    });

    //Agregar codigo Cabys
    $(document).on("click", ".seleccionar", function() {
        $('#codigo_cabys').removeAttr('readonly');
        $('#impuesto').removeAttr('readonly');

        var pos = this.value;

        $("#codigo_cabys").val(cabys[pos]);
        $("#impuesto").val(impuesto[pos]);

        $('#codigo_cabys').attr('readonly', 'true');
        $('#impuesto').attr('readonly', 'true');
    });

    //Agregar un nuevo articulo
    $("#frm").on('submit', function(e) {
        e.preventDefault();

        var response = insertFrm('articulo');

        if(response.error)
        {
            mensajeAutomatico('Atencion',
                response.error.mensaje, 'warning');
        }
    });

    //Modificar un cliente
    $(document).on('click', '.btt-mod', function() {

        $("#id_articulo").attr("disabled", false);
        
        $.ajax({
            "url": base + "empresa/update/productos",
            "method": "post",
            "data": $('#frm').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response&&!response.error) {
                swal({
                    title: "Atencion",
                    text: "Producto actualizado correctamente",
                    icon: "success",
                    timer: 3000,
                    buttons: false
                }).then(function(){
                    location.reload();    
                });//Fin del mensaje
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });//Fin de modificar un usuario

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function() {
        var id_articulo = this.value;

        $.ajax({
            "url": base + "empresa/obtener/" + id_articulo + '/productos',
            "dataType": "json",
        }).done(function(response) {
            if(response)
            {
                llenarFrm(response);

                $(".modal-title").html('Modificar articulo');

                $("#id_articulo").attr("disabled", true);
                $("#codigo").attr("disabled", true);
            }
        });
    });

    //Mostrar el modal para agregar un producto
    $(document).on('click', '#btnAgregar', function() {
        $(".modal-title").html('Agregar articulo');
        $("#codigo").attr("disabled", false);
    });
});

//Validar si el codigo del producto ya se encuentra registrado
function validarCodigo()
{
    //Obtener el codigo del producto a ingresar
    var codigo = $("#codigo").val();
    
    //Consultar en la base de datos
    $.ajax({
        "url": base + "empresa/validar/" + codigo + '/productos',
        "dataType": "json",
    }).done(function(response) {
        if (response) {
            mensaje("Alerta", "El codigo ingresado ya se encuentra registrado", "info");
        }
    });
}//Fin de la funcion para validar si ya existe el codigo ingresado
