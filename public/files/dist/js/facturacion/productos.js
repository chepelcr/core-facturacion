/**Seleccionar un producto de la base de datos */
function seleccionar_producto(id_producto, boton_producto = null) {
    if(boton_producto) {
        var linea_producto = $(boton_producto).parents(".producto");
        //Obtener la cantidad 
        var cantidad = $(linea_producto).find(".cantidad").val();

        //Obtener el precio
        var precio = $(linea_producto).find(".precio").val();
    }

    //Obtener el producto
    $.ajax({
        "url": base + "empresa/obtener/" + id_producto + "/productos",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            agregar_linea_activa(response, cantidad, precio);

            //Cerrar el modal de busqueda
            $('#modalProductos').modal('hide');
        }
    });
}

function buscar_producto() {
    //Obtener el .gnl de la linea activa
    var gnl = linea_activa.find(".gnl").val();
    
    //Si el .gnl no esta vacio
    if (gnl != '') {
        //Obtener el producto
        $.ajax({
            "url": base + "documentos/buscar_producto/" + gnl,
            "dataType": "json",
        }).done(function (response) {
            if (response && !response.error) {
                agregar_linea_activa(response, 1 , response.valor_total);
            }

            else
            {
                if(response.error) {
                    mensajeAutomatico('Atencion', response.error, 'error');
                }

                else {
                    buscar_productos(gnl);
                }
            }
        });
    }//Fin de if

    else {
        buscar_productos();
        return false;
    }
}

$(document).ready(function () {
    //Cuando se abre el modalProductos
    $('#modalProductos').on('shown.bs.modal', function () {

        //Poner el foco en el input de busqueda
        $('#modalProductos').find('#q_productos').focus();
    });
});



/**Buscar productos de la base de datos */
function buscar_productos(gnl = '') {
    //Solicitar los productos por ajax
    $.ajax({
        url: base + 'documentos/get_productos',
        type: 'GET',
        dataType: 'html',
    }).done(function (data) {
        //Agregar los productos al modal
        $('#contenedor_busqueda_productos').empty().append(data);

        if (gnl != '') {
            $('#q_productos').val(gnl);

            filtrar_tabla('productos', gnl);
        }

        //Mostrar el modal de busqueda de productos
        $('#modalProductos').modal('show');
    });
}//Fin de buscar_productos
