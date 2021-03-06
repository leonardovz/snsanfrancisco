new WOW().init();
var ruta = ruta();
$(document).ready(function () {
  traerPosts();
  traerUsuarios();
  traerServicios();
  function traerPosts() {
    $.ajax({
      type: "POST",
      url: ruta + 'php/publico.php',
      dataType: "json",
      data: 'opcion=traerPostsInicio&idServicio=' + idServicio,
      error: function (xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function (data) {
        let cuerpo = "",
          cuerpoRigth = "";
        if (data.respuesta == "exito") {
          for (let i in data.publicaciones) {
            cuerpo += (cuerpoPublicacion(data.publicaciones[i].publicacion, ruta, data.publicaciones[i].rutaImagen));
          }
          $("#contPersonasPub").html(cuerpo);
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
      data: 'opcion=traerPerfilPublico&idServicio=' + idServicio,
      error: function (xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function (data) {
        let cuerpo = "",
          cuerpoRigth = "";
        if (data.respuesta == "exito") {
          for (let i in data.perfiles) {
            cuerpo += (cuerpoPerfil(data.perfiles[i].usuario, ruta, data.perfiles[i].directorio));
          }
          $("#contPersonas").html(cuerpo);
          acciones();
        } else {
          let cuerpo = "";
          cuerpo = `
                    <div class="container my-5 py-5 z-depth-1">
                      <section class="px-md-5 mx-md-5 dark-grey-text text-center">
                        <div class="row d-flex justify-content-center">
                          <div class="col-lg-8">
                            <div class="row">
                              <div class="col-md-3 col-6 mb-4">
                                <i class="fas fa-gem fa-3x blue-text"></i>
                              </div>
                              <div class="col-md-3 col-6 mb-4">
                                <i class="fas fa-chart-area fa-3x teal-text"></i>
                              </div>
                              <div class="col-md-3 col-6 mb-4">
                                <i class="fas fa-cogs fa-3x indigo-text"></i>
                              </div>
                              <div class="col-md-3 col-6 mb-4">
                                <i class="fas fa-cloud-upload-alt fa-3x deep-purple-text"></i>
                              </div>
                            </div>
                            <p>¡No existe ninguna persona registrada aún en este servicio!, ¡Puedes ser el primero! 
                              Es completamente <b>¡GRATIS!</b> registrar tu servicio
                            </p>
                            <p><a class="btn btn-info" href="${ruta}planes">REGISTRAR</a></p>
                          </div>
                        </div>
                      </section>
                    </div>
                    `;
          $("#contPersonas").html(cuerpo);
        }
      }
    });
  }

  function cuerpoPublicacion(publicacion, ruta, rutaImagen) {
    var cuerpo = ``;
    let nombreMin = publicacion.nombre.replace(" ", "-"),
      apellidoMin = publicacion.apellidos.replace(" ", "-"),
      nameUser = nombreMin + '-' + apellidoMin,
      fecha = publicacion.fecha.split(" "),
      numDesc = publicacion.descripcion.length;
    cuerpo += `
          <div class="col-xl-4 col-lg-4 col-md-6 mb-5">
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
  function traerServicios() {
    $.ajax({
      type: "POST",
      url: ruta + 'php/publico.php',
      dataType: "json",
      data: 'opcion=serviciosInicio',
      error: function (xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function (data) {
        if (data.respuesta == 'exito') {
          var cuerpo = '';
          for (let i in data.servicios) {
            cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
          }
          $("#serviciosBody").html(cuerpo);
          new WOW().init();
        } else {

        }
      }
    });
  }

  function cuerpoServicios(servicio, ruta, rutaImagen) {
    var cuerpo = ``;
    cuerpo += `
      <div class="col-md-6 col-sm-6 col-12 mb-4 wow fadeInDown">
         
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