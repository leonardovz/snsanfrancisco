var ruta = ruta();
var $publicacion = $('.oculta');
$publicacion.hide();
$("#cancelar").parent().hide();
$(document).ready(function () {
    traerPosts();
    traerPostsDerecha();
    var $progressPub = $("#progressPub");
    function traerPosts() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publico.php',
            dataType: "json",
            data: 'opcion=traerPostsPerfil&idUsuario=' + perfilAC,
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                // console.log(data);
                if (data.respuesta == 'exito') {
                    loading(75);
                    setTimeout(() => {
                        loading(100);
                        setTimeout(() => {
                            // $progressPub.parent().parent().hide();
                            let cuerpo = "",
                                cuerpoRigth = "";
                            for (let i in data.publicaciones) {
                                if (i < 6) {
                                cuerpo += (cuerpoPublicacion(data.publicaciones[i], ruta, data.rutaImagen));
                                }
                            }
                            $("#cuerpoPublicaciones").html(cuerpo);
                            wowElement();
                            acciones();
                        }, 1000);
                    }, 1000);
                } else {
                    setTimeout(() => {
                        $("#cuerpoPublicaciones").html("");
                        $("#cuerpoRigth").html("");
                    }, 3000);
                }
            }
        });
    }
    function traerPostsDerecha() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publico.php',
            dataType: "json",
            data: 'opcion=traerPostsRelacion&idUsuario=' + perfilAC,
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                console.log(data);
                if (data.respuesta == "exito") {
                    let cuerpo = "";
                    for (let i in data.publicaciones) {
                        cuerpo += (cuerpoRigthPub(data.publicaciones[i].publicacion, ruta, data.publicaciones[i].directorio));
                    }
                    $("#cuerpoRigth").html(cuerpo);
                } else {

                }
            }
        });
    }
    function loading(tiempo, limite = 75) {
        $progressPub.width(tiempo + '%').attr('aria-valuenow', tiempo).text(tiempo + '%');
    }
    function cuerpoPublicacion(publicacion, ruta, rutaImagen) {
        var cuerpo = ``;
        let nombreMin = publicacion.nombre.replace(" ", "-"),
            apellidoMin = publicacion.apellidos.replace(" ", "-"),
            nameUser = nombreMin + '-' + apellidoMin,
            fecha = publicacion.fecha.split(" "),
            numDesc = publicacion.descripcion.length;
        cuerpo += `
              <div class="col-lg-6 col-md-12 mb-5">
                <div class="card card-personal mb-md-0 mb-4" style="height:100%;">
                  <div class="overlay">
                  <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}">
                  <div class="mask"></div>
                  <img class="card-img-top" src="${ruta}${rutaImagen}${publicacion.imagen}" alt="Card image cap">
                    </a>
                  </div>
                  <div class="card-body">
                    <a href="${ruta}perfil/${rellenarCero(publicacion.iduser)}/${normalize(nameUser)}" class="text-dark">
                      <h4 class="card-title">${publicacion.nombre} ${publicacion.apellidos}</h4>
                    </a>
                    <a class="card-meta">${publicacion.titulo}</a>
                    <p class="card-text">${publicacion.descripcion.substr(0, 55)}${((numDesc > 55) ? `<span class="" style="display:none;">${publicacion.descripcion.substr(55, numDesc)}</span> <a class="text-info mostrarTexto"> ... más </a> ` : "")}</p>
                    <hr>
                    <p class="card-meta float-right">${fecha[0]}</p>
                  </div>
                </div>
              </div>
              `;
        return cuerpo;
    }
    function cuerpoRigthPub(publicacion, ruta, rutaImagen) {
        var cuerpo = ``;
        let nombreMin = publicacion.nombre.replace(" ", "-"),
            apellidoMin = publicacion.apellidos.replace(" ", "-"),
            nameUser = nombreMin + '-' + apellidoMin,
            fecha = publicacion.fecha.split(" ");


        cuerpo += `
            <div class="row mt-5">
                <div class="col-3">
                    <div class="view overlay rounded mb-lg-0 mb-4 p-0">
                        <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}" ><img class="img-fluid" src="${ruta + rutaImagen + publicacion.imagen}" alt="Sample image"></a>
                        <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                </div>
                <div class="col-9">
                    <p class="font-weight-bold dark-grey-text">
                        <span>${publicacion.nombreServicio.substr(0, 18) + ((publicacion.nombreServicio.length > 18) ? "... " : ". ")}</span>
                        <span ><a href="${ruta + 'blog/publicacion/' + (publicacion.id)}"><span class="ml-4 m-0 badge pink"> Visualizar </span></a></span>
                    </p>

                    <div class="d-flex justify-content-between">
                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                            <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}" class="dark-grey-text">${publicacion.descripcion.substr(0, 32) + ((publicacion.descripcion.length > 32) ? "... " : ". ")}</a>
                        </div>
                        <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}"><i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            `;
        return cuerpo;
    }
    function acciones() {
        $(".mostrarTexto").off().on('click', function (e) {
            e.preventDefault();
            let opcionMostrar = $(this);
            let descripcion = $(this).siblings();
            descripcion.show();
            opcionMostrar.remove();
        });
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
