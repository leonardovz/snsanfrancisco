var ruta = ruta();
var $publicacion = $('.oculta');
$publicacion.hide();
$("#cancelar").parent().hide();
$(document).ready(function () {

    var PUBLICACIONES = [];

    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var $progress = $('#progresoPub');
    var $progressBar = $('#progresoPubBarra');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

    var $progressPub = $("#progressPub");
    loading(50);
    function loading(tiempo, limite = 75) {
        $progressPub.width(tiempo + '%').attr('aria-valuenow', tiempo).text(tiempo + '%');
    }

    $("#titulo").on('click', function (e) {
        $publicacion.show();
        $("#cancelar").parent().show();
    });
    $("#cancelar").on('click', function (e) {
        // e.preventDefault()
        $(this).parent().hide();
        $publicacion.hide();
    });
    $('[data-toggle="tooltip"]').tooltip();
    $("#buscarImagen").on('click', function (e) {
        e.preventDefault();
        $("#input").click();
        $(this).hide();
    })
    input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            input.value = '';
            image.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $("#formPublicacion").on('submit', function (e) {
        e.preventDefault();
        // if(cropper == "" || cropper.length){
        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Debes de seleccionar una imagen',
            showConfirmButton: false,
            timer: 1500
        })
        // }
    });
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 3,
            viewMode: 3,
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $("#editarFoto").on('click', function () {
        $("#avatar").click();
    });
    $("#inBusquedaPublicacion").change(function () {
        var busqueda = (removeSpecialChars(normalize($(this).val())));
        location.replace(ruta + 'perfil/publicaciones/busqueda-' + busqueda);
    });
    document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 1000,
                height: 1000,
            });
            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();
            $progress.show();
            $alert.removeClass('alert-success alert-warning');
            canvas.toBlob(function (blob) {
                var formData = new FormData();
                formData.append('avatar', blob, 'avatar.jpg'); //envio de la imagen
                formData.append('opcion', 'crearPublicacion'); //Añadir POST
                $("#avatar").show();
                $("#formPublicacion").off().on('submit', function (e) {
                    e.preventDefault();
                    let titulo = $("#titulo").val();
                    let descripcion = $("#descripcion").val();

                    formData.append('titulo', titulo); //Añadir POST
                    formData.append('descripcion', descripcion); //Añadir POST
                    if (titulo == "" || titulo.length < 3) {
                        alerta('Es título es demaciado corto', 'error');
                    } else if (descripcion == "" || descripcion.length < 4) {
                        let texto = (descripcion.length > 250) ? "  larga" : " corta";
                        alerta('La descripción es demaciado ' + texto, 'error');
                    } else {
                        $.ajax(ruta + 'php/publicacionesAJAX.php', {
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            xhr: function (load) {
                                var xhr = new XMLHttpRequest();

                                xhr.upload.onprogress = function (e) {
                                    var percent = '0';
                                    var percentage = '0%';
                                    if (e.lengthComputable) {
                                        percent = Math.round((e.loaded / e.total) * 99);
                                        percentage = percent + '%';
                                        $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                    }
                                };

                                return xhr;
                            },

                            success: function (response) {
                                if (response.respuesta == "exito") {
                                    $progressBar.width('100%').attr('aria-valuenow', 100).text('100%');
                                    setTimeout(() => {
                                        $alert.show().addClass('alert-success').text(response.Texto);
                                        alerta('Publicación realizada', 'success');
                                        setTimeout(() => {
                                            $("#titulo").val("");
                                            $("#descripcion").val("");
                                            $progressBar.width('0%').attr('aria-valuenow', 0).text('0%');
                                            $alert.hide().addClass('alert-primary');
                                            $("#cancelar").parent().show();
                                        }, 2000);
                                        traerPosts();
                                    }, 1000);

                                } else {
                                    // alerta(response.Texto, "error", 4000);
                                    Swal.fire(
                                        '¡ERROR!',
                                        response.Texto,
                                        'error'
                                    )
                                }
                            },

                            error: function (xhr, status) {
                                console.log(xhr.responseText);
                                avatar.src = initialAvatarURL;
                                $alert.show().addClass('alert-warning').text('Error al realizar la publicación');
                            },
                            complete: function () {
                                setTimeout(() => {
                                    $progress.hide();
                                }, 2000);
                            },
                        });
                    }

                })
            });
        }
    });

    traerPosts();
    function traerPosts() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publicacionesAJAX.php',
            dataType: "json",
            data: `opcion=traerPostsPerfil&pagina=${paginaAC}&busqueda=${busqueda}`,
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                if (data.respuesta == 'exito') {
                    loading(75);
                    setTimeout(() => {
                        loading(100);
                        setTimeout(() => {
                            $progressPub.parent().parent().hide();
                            PUBLICACIONES = data.publicaciones;
                            let cuerpo = "",
                                cuerpoRigth = "";
                            for (let i in PUBLICACIONES) {
                                cuerpo += (cuerpoPublicacion(PUBLICACIONES[i], ruta, data.rutaImagen));
                            }
                            $("#cuerpoPublicaciones").html(cuerpo);
                            $("#cuerpoRigth").html(cuerpoRigth);
                            paginaAC = parseInt(paginaAC);
                            paginaAC = (paginaAC) ? paginaAC : 1;
                            paginar(paginaAC, data.totalPublicaciones, ruta + 'perfil/publicaciones/' + busquedaRuta);

                            wowElement();
                            acciones();
                            accionesPublicacion();
                        }, 1000);
                    }, 1000);
                } else {
                    setTimeout(() => {
                        $("#cuerpoPublicaciones").html("");
                        // $("#cuerpoRigth").html("");
                    }, 3000);
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
              <div class="col-lg-6 col-md-12 mb-5">
                <div class="card card-personal mb-md-0 mb-4" style="height:100%;">
                  <div class="overlay">
                  <a href="${ruta + 'blog/post/' + (publicacion.id)}">
                  <div class="mask"></div>
                  <img class="card-img-top" src="${ruta}${rutaImagen}${publicacion.imagen}" alt="Card image cap">
                    </a>
                  </div>
                  <div class="card-body">
                    <div>
                        <a href="${ruta}perfil/${rellenarCero(publicacion.iduser)}/${normalize(nameUser)}" class="text-dark">
                        <h4 class="card-title">${publicacion.nombre} ${publicacion.apellidos}</h4>
                        </a>
                        <a class="card-meta">${publicacion.titulo}</a>
                        ${publicacion.descripcion}
                        <hr>
                        <p class="card-meta float-right">${fecha[0]}</p>
                        <div data-idPub="${publicacion.id}" data-titulo="${publicacion.titulo}">
                            <button type="button" class="btn btn-info btn-sm editarPub"><i class="fas fa-edit mx-2"></i></button>
                            <button type="button" class="btn btn-danger btn-sm ml-5 px-2 eliminarPub"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
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
    function accionesPublicacion() {
        var contador = 0;
        var BotonMaster = false;
        $(".editarPub").off().on('click', function (e) {
            e.preventDefault();
            let Button = $(this);
            if (contador == 0) {
                modificar(Button);
            } else {
                Swal.fire({
                    title: 'Ya estas modificando una publicación',
                    text: "¿Deceas cancelar y modificar la seleccionada?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, modificar la seleccionada'
                }).then((result) => {
                    if (result.value) {
                        if (BotonMaster) {
                            cerrarForm(BotonMaster);
                        }
                        modificar(Button);
                    }
                })
            }
            function modificar(Button) {
                BotonMaster = Button;
                let idPublicacion = Button.parent().attr('data-idPub');
                let titulo = Button.parent().attr('data-titulo');
                let descripcion = "";
                for (const i in PUBLICACIONES) {
                    if (PUBLICACIONES[i].id == idPublicacion) {
                        descripcion = (PUBLICACIONES[i].descripcion);

                    }
                }
                contador = 1;
                Button.parent().parent().hide();//Ocultamos la información
                Button.parent().parent().parent().append(`
                    <form id="formularioPublicacion" class="text-center">
                        <div class="md-form mt-3">
                            <input type="text" id="titulo" name="titulo" class="form-control" value="${titulo}">
                            <label class="active" for="titulo">Título</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea id="descripcionForm" name="descripcion" class="form-control" rows="3">${descripcion}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Guardar</button>
                        <a id="cancelarForm" class="btn btn-outline-danger btn-rounded btn-block z-depth-0 my-4 waves-effect">Cancelar</a>
            
                    </form>
                `);//Concatenamos el formulario
                $("#descripcionForm").summernote();

                $("#cancelarForm").on('click', function (e) {
                    e.preventDefault();
                    cerrarForm(BotonMaster);
                });
                $("#formularioPublicacion").on('submit', function (e) {
                    e.preventDefault();
                    let formulario = $(this).serialize();
                    let datos = "opcion=editarPublicacion&idPublicacion=" + idPublicacion + "&" + formulario;
                    enviarForm(datos);
                });
            }



        });
        $(".eliminarPub").off().on('click', function (e) {
            e.preventDefault();
            let Button = $(this);
            let idPublicacion = Button.parent().attr('data-idPub');
            Swal.fire({
                icon: 'warning',
                title: '¿Realmente deceas continuar?',
                text: "Estas apunto de eliminar tu publicación!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.value) {
                    let datos = "opcion=eliminarPublicacion&idPublicacion=" + idPublicacion;
                    enviarForm(datos, Button);
                }
            });
        });
        function destruirPub(Button) {
            Button.parent().parent().parent().parent().parent().remove();
        }
        function cerrarForm(Button) {
            formularioPublicacion.remove();
            contador = 0;
            Button.parent().parent().show();
        }
        function enviarForm(data, Button = false) {
            $.ajax({
                type: "POST",
                url: ruta + 'php/publicacionesAJAX.php',
                dataType: "json",
                data: data,
                error: function (xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function (data) {
                    if (data.respuesta == "removido") {
                        destruirPub(Button);
                        alerta(data.Texto, 'success', '1000');
                    } else if (data.respuesta == "exito") {
                        traerPosts();
                        alerta(data.Texto, 'success', '1000');
                    } else {
                        alerta(data.Texto, 'error', '3000');
                    }
                }
            });
        }
    }
    function paginar(pagina, paginas, rutaDir = "") {
        let total = paginas,
            elementos = 5;
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


    function alerta(texto, tipo, tiempo = 1500) {
        Swal.fire({
            position: 'top-end',
            type: tipo,
            title: texto,
            showConfirmButton: false,
            timer: tiempo
        })
    }
});
