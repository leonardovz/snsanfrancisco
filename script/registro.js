new WOW().init();
$(".wow").on('click', (e) => {
    e.preventDefault();
});
var ruta = ruta();
$(document).ready(() => {
    $("#formRegistro").on('submit', function (e) {
        e.preventDefault();
        var formulario = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: ruta + 'php/usuariosAJAX.php',
            data: 'opcion=registro&' + formulario,
            dataType: 'json',
            error: function (xhr, status) {
                // console.log(JSON.stringify(xhr));
                Swal.fire('exito!', "Registro realizado correctamente, no fue posible enviar su correo electronico", 'warning');
            },
            success: function (data) {
                // console.log(data);
                if (data.respuesta == 'exito') {
                    Swal.fire('¡Exito!', data.Texto, 'exito');

                } else {
                    var posicion = $("#apellido").offset().top;
                    $("#errores").html(`<div class="alert alert-primary" role="alert"> ${data.Texto} </div>`);
                    $("html, body").animate({
                        scrollTop: posicion
                    }, 2000);
                    Swal.fire('¡Error!', data.Texto, 'error');
                }
            }
        });
    });

});