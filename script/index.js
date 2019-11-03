new WOW().init();
// $(".wow").on('click', (e) => {
//   e.preventDefault();
// });
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
          $("#cuerpoPublicaciones").html(cuerpo);
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
            <p class="card-meta float-left" style="font-size: 1.75em;">
              <a target="_blank" href="https://m.me/EsthelaAngulo1.0" class="text-primary"><i class="fab fa-facebook-messenger"></i></a>
              ${((perfil.whatsapp == perfil.celular) ? '<a target="_blank" href="https://api.whatsapp.com/send?phone=' + ruta + ' class="text-success mx-5"><i class="fab fa-whatsapp"></i></a>' : "")}
            </p>
            <p class="card-meta float-right">Agendar una Cita</p>
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
        console.log(data);
        if (data.respuesta == 'exito') {
          var cuerpo = '';
          for (let i in data.servicios) {
            cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
          }
          $("#contServicios").html(cuerpo);
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
      <div class="col-md-6 col-sm-6 col-12 mb-4 wow fadeInDown">
          <div class="card card-image" style="background-image: url(${ruta + rutaImagen + servicio.imagen}); background-repeat: no-repeat; background-size: cover;">
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

  function alerta(texto, tipo) {
    Swal.fire({
      position: 'top-end',
      type: tipo,
      title: texto,
      showConfirmButton: false,
      timer: 1500
    })
  }
  $("#btnContacto").on('click', function () {
    var nombre = $("#nombreCon"),
      correo = $("#correoCon"),
      mensaje = $("#mensajeCon"),
      sub = $("#subscripcionCon");
    if (sub.is(':checked')) {
      sub = 1;
    } else {
      sub = 0;
    }
    Swal.fire({
      title: '¿Estás seguro?',
      text: "¡Estas apunto de enviar un mensaje de contacto!",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si seguro!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: ruta + 'php/publico.php',
          dataType: "json",
          data: `opcion=enviarCorreoContacto&nombre=${nombre.val()}&correo=${correo.val()}&descripcion=${mensaje.val()}&subscripcion=${sub}&tipo=contacto`,
          error: function (xhr, resp) {
            console.log(xhr.responseText);
          },
          success: function (data) {
            nombre.val("");
            correo.val("");
            mensaje.val("");
            alerta(data.Texto, 'success');
          }
        });
      }
    });


  });
});