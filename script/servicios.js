new WOW().init();
var ruta = ruta();

$("#cancelar").parent().hide();
$(document).ready(function () {
    traerPosts();
    function traerPosts() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publicacionesAJAX.php',
            dataType: "json",
            data: 'opcion=traerServicios',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                console.log(data);
                if (data.respuesta == 'exito') {
                    var cuerpo='';
                    for (let i in data.servicios) {
                        cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
                    }
                    $("#serviciosSystem").html(cuerpo);
                    new WOW().init();
                    // wowElement();
                } else {

                }
            }
        });
    }

    function cuerpoServicios(servicio, ruta, rutaImagen) {
        var cuerpo = ``;
        cuerpo += `
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 wow fadeInDown">
           
            <div class="card card-image" style="background-image: url(${ruta+rutaImagen+servicio.imagen}); background-repeat: no-repeat; background-size: cover;">

                <!-- Content -->
                <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                    <div>
                        <h5 class="pink-text"><i class="${servicio.icono} mx-3"></i> ${servicio.nombre}</h5>
                        <h3 class="card-title pt-2"><strong>${servicio.descripcion}</strong></h3>
                        <p></p>
                        <a class="btn ${servicio.color}"><i class="fas fa-clone left"></i> Ver</a>
                    </div>
                </div>
            </div>
        </div>
            `;
        //}
        return cuerpo;
    }

    function alerta(texto, tipo) {
        Swal.fire({
            position: 'top-end',
            type: tipo,
            title: texto,
            showConfirmButton: false,
            timer: 1500
        })
    }

});
