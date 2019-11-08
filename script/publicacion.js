var ruta = ruta();
var $publicacion = $('.oculta');
$publicacion.hide();
$("#cancelar").parent().hide();
$(document).ready(function () {
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
        // setTimeout(() => {
        $progressPub.width(tiempo + '%').attr('aria-valuenow', tiempo).text(tiempo + '%');
        //     console.log(tiempo);
        //     tiempo++;
        //     if(tiempo<=limite && false){
        //         loading(tiempo);

        //     }
        // }, 50);
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
            aspectRatio: 1.5,
            viewMode: 3,
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $("#editarFoto").on('click', function () {
        $("#avatar").click();
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
                        alerta('Es titulo es demaciado corto', 'error');
                    } else if (descripcion == "" || descripcion.length < 4) {
                        let texto = (descripcion.length > 250) ? "  larga" : " corta";
                        alerta('La descripción es demaciado ' + texto, 'error');
                    } else {
                        $.ajax(ruta + 'php/usuariosFunciones.php', {
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
                                }, 1000);
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
            url: ruta + 'php/usuariosFunciones.php',
            dataType: "json",
            data: 'opcion=traerPostsPerfil',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                console.log(data);
                if (data.respuesta == 'exito') {
                    loading(75);
                    setTimeout(() => {
                        loading(100);
                        setTimeout(() => {
                            $progressPub.parent().parent().hide();
                            let cuerpo = "",
                                cuerpoRigth = "";
                            for (let i in data.publicaciones) {
                                if (i < 6) {
                                    cuerpo += (cuerpoPublicacion(data.publicaciones[i], ruta, data.rutaImagen));
                                } else {
                                    cuerpoRigth += (cuerpoRigthPub(data.publicaciones[i], ruta, data.rutaImagen));
                                }
                            }
                            $("#cuerpoPublicaciones").html(cuerpo);
                            $("#cuerpoRigth").html(cuerpoRigth);

                            wowElement();
                            acciones();
                            accionesPublicacion();
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
                    <div>
                        <a href="${ruta}perfil/${rellenarCero(publicacion.iduser)}/${normalize(nameUser)}" class="text-dark">
                        <h4 class="card-title">${publicacion.nombre} ${publicacion.apellidos}</h4>
                        </a>
                        <a class="card-meta">${publicacion.titulo}</a>
                        <p class="card-text">${publicacion.descripcion.substr(0, 55)}${((numDesc > 55) ? `<span class="" style="display:none;">${publicacion.descripcion.substr(55, numDesc)}</span> <a class="text-info mostrarTexto"> ... más </a> ` : "")}</p>
                        <hr>
                        <p class="card-meta float-right">${fecha[0]}</p>
                        <div data-idPub="${publicacion.id}" data-titulo="${publicacion.titulo}" data-descripcion="${publicacion.descripcion}">
                            <button type="button" class="btn btn-info btn-sm editarPub"><i class="fas fa-edit mx-2"></i></button>
                            <button type="button" class="btn btn-danger btn-sm eliminarPub"><i class="fas fa-trash-alt mx-2"></i></button>
                        </div>
                    </div>
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
                        <img class="img-fluid" src="${ruta + rutaImagen + publicacion.imagen}" alt="Sample image">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                </div>
                <div class="col-9">
                    <p class="font-weight-bold dark-grey-text">
                        <span>${fecha[0]}</span>
                        <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}"><span class="ml-4 m-0 badge pink"> Visualizar </span></a>
                    </p>

                    <div class="d-flex justify-content-between">
                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                            <a href="${ruta + 'blog/publicacion/' + (publicacion.id)}" class="dark-grey-text">${publicacion.descripcion.substr(0, 32) + ((publicacion.descripcion.length > 32) ? "... " : ". ")}</a>
                        </div>
                        <a><i class="fas fa-angle-double-right"></i></a>
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
                let descripcion = Button.parent().attr('data-descripcion');
                contador = 1;
                Button.parent().parent().hide();//Ocultamos la información
                Button.parent().parent().parent().append(`
                    <form id="formularioPublicacion" class="text-center">
                    <input type="hidden" name="idPublicacion" class="form-control" value="${idPublicacion}">
                        <div class="md-form mt-3">
                            <input type="text" id="titulo" class="form-control" value="${titulo}">
                            <label class="active" for="titulo">Titulo</label>
                        </div>
                        <div class="md-form">
                            <textarea id="descripcion" class="form-control md-textarea" rows="3">${descripcion}</textarea>
                            <label class="active" for="descripcion">Descripcion</label>
                        </div>
                        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Guardar</button>
                        <a id="cancelarForm" class="btn btn-outline-danger btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Cancelar</a>
            
                    </form>
                `);//Concatenamos el formulario
                $("#cancelarForm").on('click', function (e) {
                    e.preventDefault();
                    cerrarForm(BotonMaster);
                })
            }
            function cerrarForm(Button) {
                formularioPublicacion.remove();
                contador = 0;
                Button.parent().parent().show();
            }

        });
        $(".eliminarPub").off().on('click', function (e) {
            e.preventDefault();
            let Button = $(this);
            let idPublicacion = Button.parent().attr('data-idPub');
            console.log(idPublicacion);
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
