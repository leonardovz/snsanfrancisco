new WOW().init();
var ruta = ruta();

$("#cancelar").parent().hide();
$(document).ready(function () {
    traerServicios();
    setTimeout(() => {
        traerPosts();
        traerUsuarios();
    }, 1000);
    function traerServicios() {
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
                    var cuerpo = '';
                    for (let i in data.servicios) {
                        cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
                    }
                    $("#serviciosSystem").html(cuerpo);
                    new WOW().init();
                } else {

                }
            }
        });
    }
    function traerPosts() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publico.php',
            dataType: "json",
            data: 'opcion=traerPostsInicio',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                console.log(data);
                let cuerpo = "",
                    cuerpoRigth = "";
                if (data.respuesta == "exito") {
                    for (let i in data.publicaciones) {
                        cuerpo += (cuerpoPublicacion(data.publicaciones[i].publicacion, ruta, data.publicaciones[i].rutaImagen));
                    }
                    $("#publicacionesBody").html(cuerpo);
                    $("#cuerpoRigth").html(cuerpoRigth);
                    acciones();
                } else {
                    alerta(data.Texto, 'error');
                }

            }
        });
    }
    function traerUsuarios() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publico.php',
            dataType: "json",
            data: 'opcion=traerPerfilPublico',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                // console.log(data);
                let cuerpo = "",
                    cuerpoRigth = "";
                if (data.respuesta == "exito") {
                    for (let i in data.perfiles) {
                        cuerpo += (cuerpoPerfil(data.perfiles[i].usuario, ruta, data.perfiles[i].directorio));
                    }
                    $("#cuerpoPerfiles").html(cuerpo);
                    $("#cuerpoRigth").html(cuerpoRigth);
                    acciones();
                } else {
                    alerta(data.Texto, 'error');
                }
            }
        });
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
    function cuerpoPerfil(perfil, ruta, rutaImagen) {
        var cuerpo = ``;
        let nombreMin = perfil.nombre.replace(" ", "-"),
            apellidoMin = perfil.apellidos.replace(" ", "-"),
            nameUser = nombreMin + '-' + apellidoMin,
            fecha = perfil.fecha.split(" ");
        cuerpo += `
          <div class="col-xl-4 col-lg-4 col-md-6 mb-5">
            <div class="card card-personal mb-md-0 mb-4">
              <div class="overlay"> 
                <a href="${ruta}perfil/${rellenarCero(perfil.idUsuario)}/${normalize(nameUser)}"">
                  <img class="card-img-top" src="${ruta}${(perfil.img == 'default.png') ? "galeria/sistema/images/" : rutaImagen}${perfil.img}"" alt="Card image cap">
                </a>
              </div>
              <div class="card-body">
                <a>
                  <h4 class="card-title">${perfil.nombreServicio}</h4>
                </a>
                <a class="card-meta">${perfil.servicio} <span><i class="${perfil.iconoS} ${perfil.colorS}-text mx-3" > </i></span></a>
                <p class="card-text">${perfil.nombre} ${perfil.apellidos}</p>
                <hr>
                <p class="card-meta text-center"><a class="btn ${perfil.colorS} text-white btn-md" href="${ruta}perfil/${rellenarCero(perfil.idUsuario)}/${normalize(nameUser)}" >Visitar Perfil</a> </p>
              </div>
            </div>
          </div>
              `;
        return cuerpo;
    }
    function cuerpoServicios(servicio, ruta, rutaImagen) {
        var cuerpo = ``;
        cuerpo += `
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 wow fadeInDown">
           
            <div class="card card-image" style="background-image: url(${ruta + rutaImagen + servicio.imagen}); background-repeat: no-repeat; background-size: cover;">

                <!-- Content -->
                <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                    <div>
                        <h5 class="pink-text"><i class="${servicio.icono} mx-3"></i> ${servicio.nombre}</h5>
                        <h3 class="card-title pt-2"><strong>${servicio.descripcion}</strong></h3>
                        <p></p>
                        <a href="${ruta}servicios/${servicio.id}/${normalize(servicio.nombre).replace(" ", "-")}" class="btn ${servicio.color}"><i class="fas fa-clone left"></i> Ver</a>
                    </div>
                </div>
            </div>
        </div>
            `;
        //}
        return cuerpo;
    }
    function cuerpoPublicacion(publicacion, ruta, rutaImagen) {
        var cuerpo = ``;
        let nombreMin = publicacion.nombre.replace(" ", "-"),
            apellidoMin = publicacion.apellidos.replace(" ", "-"),
            nameUser = nombreMin + '-' + apellidoMin,
            fecha = publicacion.fecha.split(" "),
            numDesc = publicacion.descripcion.length;
        cuerpo += `
              <div class="col-lg-4 col-md-6 mb-5">
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

    function alerta(texto, tipo) {
        Swal.fire({
            position: 'top-end',
            type: tipo,
            title: texto,
            showConfirmButton: false,
            timer: 1500
        })
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

});
