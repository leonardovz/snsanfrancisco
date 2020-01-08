new WOW().init();
var ruta = ruta();
$(document).ready(function () {
  var BUSQUEDA = (window.location.pathname).split("/")[2].replace(/-/g, " ");//Cacha la ruta y separa los datos para enviar a SQL
  traerPosts();
  $("#inBusqueda").val(BUSQUEDA);
  function traerPosts() {
    var contPersonas = $("#contPersonas");
    var contServicios = $("#contServicios");
    var contPersonasPub = $("#contPersonasPub");
    $.ajax({
      type: "POST",
      url: ruta + 'php/publico.php',
      dataType: "json",
      data: 'opcion=busqueda&buscar=' + BUSQUEDA,
      error: function (xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function (data) {
        if (data.respuesta == "exito") {
          let cuerpoPub = "";
          let cuerpoUser = "";
          let cuerpoServ = "";
          if (data.Perfil) {
            for (let i in data.Perfil) {
              cuerpoPub += (cuerpoPerfil(data.Perfil[i].Perfil, ruta, data.Perfil[i].rutaImagen));
            }
            contPersonas.html(cuerpoPub);

          }
          if (data.Servicio) {
            for (let i in data.Servicio) {
              cuerpoUser += (cuerpoServicios(data.Servicio[i].Servicio, ruta, data.Servicio[i].rutaImagen));
            }
            contServicios.html(cuerpoUser);
          } else {
            contServicios.hide();
          }
          if (data.Publicacion) {
            for (let i in data.Publicacion) {
              cuerpoServ += (cuerpoPublicacion(data.Publicacion[i].Publicacion, ruta, data.Publicacion[i].rutaImagen));
            }
            contPersonasPub.html(cuerpoServ);
          }
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
  function traerBlogs(blogPublicacion = false) {
    var tituloPrincipal = $("#tituloPrincipal");
    var imagenPrincipal = $("#imagenPrincipal");
    var cuerpoPrincipal = $("#cuerpoPrincipal");
    blogPublicacion = (blogPublicacion) ? "&idPublicacion=" + blogPublicacion : "";
    $.ajax({
      type: "POST",
      url: ruta + 'php/publicacionesAJAX.php',
      dataType: "json",
      data: `opcion=traerPostsBlog&pagina=${paginaAC}&busqueda=${busqueda}${blogPublicacion}`,
      error: function (xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function (data) {
        if (data.respuesta == 'exito') {
          PUBLICACIONES = data.publicaciones;
          setTimeout(() => {
            let cuerpo = "",
              cuerpoRigth = "";
            for (let i in PUBLICACIONES) {
              if (i == 0) {
                tituloPrincipal.html(PUBLICACIONES[i].titulo);
                imagenPrincipal.html(`<img class="rounded z-depth-3 mt-0 pt-0" src="${ruta + data.rutaImagen}${PUBLICACIONES[i].imagen}" alt="avatar" style="width: 100%;">`);
                cuerpoPrincipal.html(PUBLICACIONES[i].descripcion);
              } else {
                cuerpo += (cuerpoPostBlog(PUBLICACIONES[i], ruta, data.rutaImagen));
              }
            }
            $("#cuerpoPostBlog").html(cuerpo);
            $("#cuerpoRigth").html(cuerpoRigth);
            paginaAC = parseInt(paginaAC);
            paginaAC = (paginaAC) ? paginaAC : 1;
            paginar(paginaAC, data.totalPublicaciones, ruta + 'blog/' + busquedaRuta);

            acciones();
          }, 1000);
        } else {
          setTimeout(() => {
            $("#cuerpoPostBlog").html("");
          }, 3000);
        }
      }
    });
  }
  function cuerpoPostBlog(publicacion, ruta, rutaImagen) {
    var cuerpo = ``;
    let nombreMin = publicacion.nombre.replace(" ", "-"),
      apellidoMin = publicacion.apellidos.replace(" ", "-"),
      nameUser = nombreMin + '-' + apellidoMin;
    var fecha = publicacion.fecha.split(" ")[0];
    fecha = fecha.split("-");
    fecha = MESES[fecha[1]] + " de " + fecha[0];
    numDesc = publicacion.descripcion.length;
    cuerpo += `
        <div class="col-md-6 mb-4">
            <div class="card card-personal mb-md-0 m-1">
                <div class="view overlay">
                    <img class="card-img-top" src="${ruta}${rutaImagen}${publicacion.imagen}" alt="Card image cap">
                    <a href="${ruta + 'blog/post/' + (publicacion.id)}">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <div class="card-body">
                    <a>
                        <h4 class="card-title h6">${publicacion.titulo}.</h4>
                    </a>
                    <p class="card-text">By <a  class="card-text" href="${ruta}perfil/${rellenarCero(publicacion.iduser)}/${normalize(nameUser)}" > ${publicacion.nombre} ${publicacion.apellidos} </a></p>
                    <hr>
                    <a class="card-meta text-justify"><span><i class="fas fa-user mx-2"></i>${publicacion.vistas} Vistas</span> <a class="card-text text-right ml-2 "> ${fecha} </a></a>
                </div>
            </div>
        </div>
          `;
    return cuerpo;
  }
  function paginar(pagina, paginas, rutaDir = "") {
    let total = paginas,
      elementos = 6;
    if (true) {
      paginas = ((total % elementos) > 0) ? Math.trunc(total / elementos) + 1 : Math.trunc(total / elementos)
    }
    if (pagina > paginas) {
      pagina = 1;
    }
    var elementosCard = 9; //Numero de elementos para realizar la paginación
    // var recorrido = (paginas > elementosCard) ? (((paginas % elementosCard) > 0) ? Math.trunc(paginas / elementosCard) + 1 : Math.trunc(paginas / elementosCard)) : paginas;
    var i = (Math.trunc(pagina / elementosCard)) * elementosCard;
    var limite = i + elementosCard;
    if ((pagina + elementosCard) > paginas) { //Validar que los elementos no sobrepasen el limite
      i = paginas - elementosCard; //Asignación inicio del ciclo
      limite = paginas //Asignación fin del ciclo
    }
    i = (i < 1) ? 1 : i;
    var cuerpo = `<ul class="pagination">`;
    cuerpo += ` <li class="page-item ${((pagina <= 1) ? " disabled" : "")}"><a class="page-link" ${((pagina <= 1) ? "" : 'href="' + rutaDir + 'pagina-' + (paginaAC - 1) + '"')}>Previous</a></li>`;
    for (i; i <= limite; i++) {
      cuerpo += `<li class="page-item ${((i == pagina) ? " active" : " ")}"><a class="page-link" ${(i == paginaAC) ? "" : 'href="' + rutaDir + 'pagina-' + i + '"'}>${i}</a></li>`;
    }
    cuerpo += `<li class="page-item ${((pagina >= paginas) ? " disabled" : "")}" ><a class="page-link" ${((pagina >= paginas) ? "" : 'href="' + rutaDir + 'pagina-' + ((paginaAC) + 1) + '"')} >Next</a></li>`;
    cuerpo += (pagina != paginas) ? `<li class="page-item ${((pagina >= paginas) ? " disabled" : "")}" ><a class="page-link" href="${rutaDir}pagina-${paginas}"><i class="fa fa-fast-forward" aria-hidden="true"></i> </a></li>` : "";
    cuerpo += `</ul>`;
    $("#paginacion").html(cuerpo);
  }
});