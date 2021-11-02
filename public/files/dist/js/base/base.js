var base = "http://localhost/modas-laura/Sitema-costos/public/";

$(document).ready(function () {
    //Sidebar dinamico
    $(".nav-link").each(function (i, e) {
        if ($(e).attr('href') == window.location.href) {
            $(e).parents().closest(".nav-item").addClass("menu-open");
            $(e).parents().closest(".nav-item").children('.nav-link').addClass("active");
            $(e).addClass("active");
        }
    });
});

document.addEventListener('keyup', (event) => {
    var name = event.key;
    var code = event.code;
    // Alert the key name and key code on keydown
    //alert(`Key pressed ${name} \r\n Key code value: ${code}`);
}, false);


//Enviar un mensaje al usuario
function mensaje(titulo, mensaje, icono) {
    Swal.fire({
        icon: icono,
        title: titulo,
        text: mensaje,
        showConfirmButton: false
      })
}//Fin del mensaje

//Mensaje que se cierra automaticamente
function mensajeAutomatico(titulo, mensaje, icono) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        timer: 2000,
        buttons: false
    })//Fin del mensaje
}
