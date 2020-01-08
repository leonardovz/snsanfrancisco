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
        $progressPub.width(tiempo + '%').attr('aria-valuenow', tiempo).text(tiempo + '%');
    }

    $("#titulo").on('click', function (e) {
        $publicacion.show();
        $("#cancelar").parent().show();
    });
    $("#cancelar").on('click', function (e) {
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
        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Debes de seleccionar una imagen',
            showConfirmButton: false,
            timer: 1500
        })
    });
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 2,
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
                formData.append('opcion', 'crearServicio'); //Añadir POST
                $("#avatar").show();
                $("#formPublicacion").off().on('submit', function (e) {
                    e.preventDefault();
                    let nombre = $("#nombre").val();
                    let color = $("#color").val();
                    let icono = $("#icono").val();
                    let descripcion = $("#descripcion").val();

                    formData.append('nombre', nombre); //Añadir POST
                    formData.append('color', color); //Añadir POST
                    formData.append('icono', icono); //Añadir POST
                    formData.append('descripcion', descripcion); //Añadir POST
                    if (nombre == "" || nombre.length < 3) {
                        alerta('El nombre es demaciado corto', 'error');
                    }
                    else if (icono == "" || icono.length < 3) {
                        alerta('El icono es demaciado corto', 'error');
                    }
                    else if (color == "" || color.length < 3) {
                        alerta('El color es demaciado corto', 'error');
                    }
                    else if (descripcion == "" || descripcion.length < 3) {
                        alerta('La descripción es demaciado corta', 'error');
                    }
                    else {
                        $.ajax(ruta + 'php/adminFunciones.php', {
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
                                        $("#nombre").val("");
                                        $("#descripcion").val("");
                                        $("#color").val("");
                                        $("#icono").val("");
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


    //Apartado de servicios y tabla 

    traerServicios();
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
                if (data.respuesta == 'exito') {
                    var cuerpo = '';
                    for (let i in data.servicios) {
                        cuerpo += (cuerpoServicios(data.servicios[i], ruta, data.rutaImagen));
                    }
                    $("#tablaServicios").html(cuerpo);
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
        <tr>
            <td>${servicio.nombre}</td>
            <td>${ruta + rutaImagen + servicio.imagen}</td>
            <td>
                <a href="${ruta}servicios/${servicio.id}/${normalize(servicio.nombre).replace(" ", "-")}" class="btn ${servicio.color} text-white"><i class="fas fa-clone left"></i> Ver</a>
            </td>
            <td>${servicio.descripcion}</td>
            <td><i class="${servicio.icono} mx-3"></i></td>
            <td><button class="btn btn-danger"><i class="far fa-edit"></i></button></td>
        </tr>
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
