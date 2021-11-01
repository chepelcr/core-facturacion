var lineas = false;
let collapse = [];

$(document).ready(function() {
    collapse.push(false);

    //Busqueda de articulos
    $("#frmBusqueda").on('submit', function(e) 
    {
        e.preventDefault();

        $('#articulos').html('');

        $.ajax({
            "url": base + 'articulo/all',
            "dataType": "json",
        }).done(function(response){
            var html = '';
            var i;

            for (i = 0; i < response.length; i++) 
            {
                html += '<tr class="articulo">' +
                    '<td>' + response[i].codigo_cabys + '</td>' +
                    '<td>' + response[i].descripcion + '</td>' +
                    '<td>' + response[i].precio + '</td>' +
                    '<td><input class="form-control cant" type="number" value="1" </input></td>' +
                    '<td><button data-dismiss="modal" type="button" class="btn btn-warning btn-sm seleccionar" value="' +
                    response[i].id_articulo + '">Seleccionar</button></td>'
                '</tr>';
            }
            
            $(".productos").prop('hidden', false);
            $('#articulos').html(html);
            

            var value = $('#q').val().toLowerCase();
            $("#articulos tr").filter(function() 
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    /**Obtener el tipo de cambio del dolar */
    $(document).on('change', '#moneda', function() {
        var moneda = this.value;
        if (moneda != "") {
            Pace.track(function() {
                $.ajax({
                    "url": "https://api.hacienda.go.cr/indicadores/tc/dolar",
                    "method": "GET",
                    "dataType": "json"
                }).done(function(response) {
                    if (moneda == "CRC") {
                        $("#tipo_cambio").val(1);
                    } else if (moneda == "USD") {
                        $("#tipo_cambio").val(response.venta.valor);
                    }
    
                });
            });
        } else {
            $("#tipo_cambio").val("");
        }
    });

    //Agregar producto
    $(document).on("click", ".seleccionar", function() {
        $('#codigo_cabys').removeAttr('readonly');
        $('#impuesto').removeAttr('readonly');

        var id_producto = this.value;
        var cantidad = $(this).parents(".articulo").find(".cant").val();

        $('#articulos').html('');

        $.ajax({
            "url": base + "articulo/obtener/" + id_producto,
            "dataType": "json",
        }).done(function(response) {
            
            if (response) 
            {
                if(!lineas)
                {
                    $(".linea").last().find(".impP").val(response.impuesto);
                    $(".linea").last().find(".descripcion").val(response.descripcion);
                    $(".linea").last().find(".codigo").val(response.codigo_cabys);
                    $(".linea").last().find(".cantidad").val(cantidad);
                    $(".linea").last().find(".unidad").val(response.unidad_medida);
                    $(".linea").last().find(".precio").val(response.precio);
                    $(".linea").last().find(".descP").val('0');

                    //$("#linea1").clone().prependTo("#tblDetalles");

                    //$(".linea").last().find("input, select").prop('value', "");
                    
                    lineas = true;
                    $(".eliminarLinea").prop('hidden', false);
                }

                else
                {
                    cloneLine();

                    $(".linea").last().find(".impP").val(response.impuesto);
                    $(".linea").last().find(".descripcion").val(response.descripcion);
                    $(".linea").last().find(".codigo").val(response.codigo_cabys);
                    $(".linea").last().find(".cantidad").val(cantidad);
                    $(".linea").last().find(".unidad").val(response.unidad_medida);
                    $(".linea").last().find(".precio").val(response.precio);

                    $(".linea").last().find(".descP").val('0');
                }
                
                calcular($(".linea").last());
            }//Fin de la validacion de respuesta
        });
    });

    $("#frmFacturar").on('submit', function(e){
        $("#btnGenerarFactura").attr('disabled', true);
        e.preventDefault();
        Pace.track(function () {
          $.ajax({
            "url": base + "documentos/guardar",
            "method": "post",
            "data": $('#frmFacturar').serialize(),
            "dataType": "json",
          }).always(function (response) {
              if(response!=0)
              {
                swal({
                    title: 'Atencion',
                    text: 'Documento generado',
                    icon: 'success',
                    time: 3000,
                    buttons: false
                }).then(function(){
                    //window.open(base + 'manager/generar_pfd/' + response);
                    location.href = base + 'documentos';
                });//Fin del mensaje
              }
              //$("#lblClave").text(response.clave);
              //si fue enviado
              //$("#lblEnviado").text(response.enviar);
              // si fuue valido
              //$("#lblValidado").text(response.validar_estado);
              /*if (response.validar_mensaje==3) {
                alert("documento rechazado");
              }
      
              $("#divValidar").html('');
              if (response.validar_estado=="procesando") {
                $("#divValidar").append('<button class="btn btn-warning btn-sm reValidar" value="'+response.clave+'">Validar</button>');
              }*/
      
      
      
            $("#btnGenerarFactura").attr('disabled', false);
          });
        });
      });
});

function calcular(linea)
{
    var cantidad = linea.find(".cantidad").val();
    var precio = linea.find(".precio").val();
    var impP = linea.find(".impP").val();

    var neto = cantidad * precio;
    neto = neto - (neto*impP) / 100;

    var descP = linea.find(".descP").val();
    var descM = (neto * descP) / 100;
    var subtotal = neto - descM;
    
    var impM = (subtotal * impP)/100;

    var totalL = subtotal + impM;

    linea.find(".neto").val(neto);
    linea.find(".descM").val(descM);
    linea.find(".subtotal").val(subtotal);
    linea.find(".impM").val(impM);
    linea.find(".totalL").val(totalL);

    totales();
}

/**Clonar una linea de la tabla */
function cloneLine()
{
    let num_linea = $(".linea").last().find(".descB").val();

    num_linea++;

    collapse.push(false);

    $("#linea1").clone().appendTo("#tblDetalles");
    
    $(".linea").last().find("input, select").prop('value', "");
    $(".linea").last().find(".descB").val(num_linea);
    $(".linea").last().find(".eliminarLinea").val(num_linea);

    $(".linea").last().find(".l_desc").prop('id', ("descuento" + num_linea));

    $(".linea").last().find(".descP").prop('value', "0");
    $(".linea").last().find(".mot").prop('value', "");

    $(".eliminarLinea").prop('hidden', false);
}

$(document).on('click', '.descB', function() {
    var num_linea = this.value;

    if(!collapse[num_linea])
    {
        $('#descuento'+num_linea).collapse('show');
        collapse[num_linea] = true;
    }

    else
    {
        $('#descuento'+num_linea).collapse('hide');
        collapse[num_linea] = false;
    }
    
});

$(document).on('keyup change', '.calcular', function() {
    calcular($(this).parents(".linea"));
});

$(document).on('click', '.agregarLinea', function() {
    cloneLine();
});

$(document).on('click', '.eliminarLinea', function() {
    if ($(".linea").length == 1) 
    {
        cloneLine();
        $(".eliminarLinea").prop('hidden', true);

        lineas = false;
    }

    $(this).parents(".linea").remove();
    calcular($(".linea").last());

    totales();
});

function totales(){
    neto=0;
    descuentos=0;
    subtotal=0;
    IVA=0;
    total=0;
  
    $(".table tbody .linea").each(function(i, item) {
      neto += parseFloat($(item).find(".neto").val());
      descuentos += parseFloat($(item).find(".descM").val());
      subtotal += parseFloat($(item).find(".subtotal").val());
      IVA += parseFloat($(item).find(".impM").val());
      total += parseFloat($(item).find(".totalL").val());
    });

    $(".lblNeto").text(parseFloat(neto).toFixed(2));
    $(".lblDescuentos").text(parseFloat(descuentos).toFixed(2));
    $(".lblSubtotal").text(parseFloat(subtotal).toFixed(2));
    $(".lblIVA").text(parseFloat(IVA).toFixed(2));
    $(".lblTotal").text(parseFloat(total).toFixed(2));
}