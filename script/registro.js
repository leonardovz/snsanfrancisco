new WOW().init();
$(".wow").on('click', (e) => {
    e.preventDefault();
});
var ruta = ruta();
$(document).ready(() => {
    registro();
    function registro() {
        $("#formRegistro").off().on('submit', function (e) {
            e.preventDefault();
            evitarCarga();
            var formulario = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: ruta + 'php/usuariosAJAX.php',
                data: 'opcion=registro&' + formulario,
                dataType: 'json',
                error: function (xhr, status) {
                    // console.log(JSON.stringify(xhr));
                    Swal.fire('exito!', "Registro realizado correctamente, no fue posible enviar su correo electronico", 'warning');
                    registro();
                },
                success: function (data) {
                    if (data.respuesta == 'exito') {
                        Swal.fire('¡Exito!', data.Texto, 'success');
                        setTimeout(() => {
                            location.href = ruta + 'login';
                        }, 1500);
                    } else {
                        var posicion = $("#apellido").offset().top;
                        $("#errores").html(`<div class="alert alert-primary" role="alert"> ${data.Texto} </div>`);
                        $("html, body").animate({
                            scrollTop: posicion
                        }, 2000);
                        Swal.fire('¡Error!', data.Texto, 'error');
                    }
                    registro();
                }
            });
        });
    }
    function evitarCarga() {
        $("#formRegistro").off().on('submit', function (e) {
            e.preventDefault();
        });
    }
});