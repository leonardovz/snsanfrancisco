new WOW().init();
$(".wow").on('click', (e) => {
    e.preventDefault();
});
var ruta = ruta();
$(document).ready(() => {
    $("#formLogin").on('submit', function (e) {
        e.preventDefault();
        var formulario = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: ruta + 'php/usuariosAJAX.php',
            data: 'opcion=login&' + formulario,
            dataType: 'json',
            error: function (xhr, status) {
                console.log(JSON.stringify(xhr));
            },
            success: function (data) {
                console.log(data);
                if (data.respuesta == 'exito') {
                    Swal.fire(
                        'Exito!',
                        data.Texto,
                        'success'
                    );
                    setInterval(() => { location.reload() }, 1500);
                } else {
                    Swal.fire(
                        'Alerta!',
                        data.Texto,
                        'error'
                    );
                }
            }
        });
    });

});