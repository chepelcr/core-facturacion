/**Ver el .modal-walmart de la factura activa */
function ver_walmart() {
    //Ocultar el contenedor de tiendas en .modal-walmart
    $('#' + factura_activa).find('.modal-walmart').find('.contenedor-tiendas').hide();

    //Mostrar el contenedor de datos en .modal-walmart
    $('#' + factura_activa).find('.modal-walmart').find('.contenedor-datos').show();

    //Mostrar el .modal-walmart de la factura activa
    $('#' + factura_activa).find('.modal-walmart').modal('show');
}//Fin de la funcion ver_walmart

/**Buscar la tienda de entrega del documento */
function buscar_tiendas() {
    //Ocutar el contenedor de datos en .modal-walmart
    $('#' + factura_activa).find('.modal-walmart').find('.contenedor-datos').hide();

    //Mostrar el contenedor de tiendas en .modal-walmart
    $('#' + factura_activa).find('.modal-walmart').find('.contenedor-tiendas').show();
}//Fin de la funcion buscar_tiendas

/**Seleccionar una tienda para el documento */
function seleccionar_tienda(id_tienda = '', nombre_tienda = '') {
    //Validar si la tienda es valida
    if (id_tienda != '' && nombre_tienda != '') {
        //Colocar el numero de tienda en el campo de .enviar_gnl de la factura activa
        $('#' + factura_activa).find('.enviar_gnl').val(id_tienda);

        //Colocar el nombre de la tienda en el campo de .nombre_gnl de la factura activa
        $('#' + factura_activa).find('.nombre_gnl').val(nombre_tienda);

        //Cerrar el contenedor de tiendas
        $('#' + factura_activa).find('.modal-walmart').find('.contenedor-tiendas').hide();

        //Mostrar el contenedor de datos en .modal-walmart
        $('#' + factura_activa).find('.modal-walmart').find('.contenedor-datos').show();
    }//Fin de validar si la tienda es valida
}//Fin de la funcion seleccionar_tienda
