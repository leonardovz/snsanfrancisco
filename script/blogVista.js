var ruta = ruta();
$(document).ready(function () {
    traerBlogs(idPostBlog);
    setTimeout(() => {
        traerBlogs(false);
    }, 1000);
    traerPosts();
    traerServicios();
    traerUsuarios();
    var PUBLICACIONES;
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
                let cuerpo = "";
                if (data.respuesta == "exito") {
                    for (let i in data.perfiles) {
                        if (i < 2) {
                            cuerpo += (cuerpoPerfil(data.perfiles[i].usuario, ruta, data.perfiles[i].directorio));
                        }
                    }
                    $("#cuerpoPerfiles").html(cuerpo);
                }
            }
        });
    }
    function cuerpoPerfil(perfil, ruta, rutaImagen) {
        var cuerpo = ``;
        let nombreMin = perfil.nombre.replace(" ", "-"),
            apellidoMin = perfil.apellidos.replace(" ", "-"),
            nameUser = nombreMin + '-' + apellidoMin,
            fecha = perfil.fecha.split(" ");
        cuerpo += `
            <div class="col-12 mb-5">
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
                // console.log(data);
                if (data.respuesta == 'exito') {
                    var cuerpo = '';
                    for (let i in data.servicios) {
                        if (i < 3) {
                            cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
                        }
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
       <div class="col-12 mb-4 wow fadeInDown">
           <div class="card card-image" style="background-image: url(${ruta + rutaImagen + servicio.imagen}); background-repeat: no-repeat; background-size: cover;">
               <div class="text-white text-center d-flex align-items-center rgba-black-strong py-3 px-2">
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
                let cuerpo = "",
                    cuerpoRigth = "";
                if (data.respuesta == "exito") {
                    for (let i in data.publicaciones) {
                        if (i < 4) {
                            cuerpo += (cuerpoPublicacion(data.publicaciones[i].publicacion, ruta, data.publicaciones[i].rutaImagen));
                        }
                    }
                    $("#cuerpoPublicaciones").html(cuerpo);
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
              <div class="col-md-6 mb-5">
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
        let idBlogPub = blogPublicacion;
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
                // console.log(data);
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
                    if (idBlogPub && getBookLocal(idBlogPub)) {
                        $.ajax({
                            url: ruta + 'php/publicacionesAJAX.php',
                            type: 'POST',
                            data: `opcion=actualizarVista&idLibro=${idBlogPub}`,
                            dataType: 'json',
                            error: function (xhr, status) {
                                console.log(xhr.responseText);
                            },
                            success: function (resp) {
                                // console.log(resp);
                            },
                        });
                    }
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
        let mes = parseInt(fecha[1]);
        fecha = MESES[mes] +mes+ " de " + fecha[0];
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
    function getBookLocal(idBook) {
        var cargar = true;
        if (localStorage.blogPost) {
            var libros = JSON.parse(localStorage.blogPost);
            var cargar = true;
            for (let i in libros) {
                if (idBook == libros[i]) {
                    cargar = false;
                }
            }
            if (cargar) {
                libros.push(parseInt(idBook));
                localStorage.setItem('blogPost', JSON.stringify(libros));
            }
        } else {
            localStorage.setItem('blogPost', '[' + idBook + ']');
        }
        return cargar;
    }
});