var ruta = ruta();
$(document).ready(function () {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

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
    $("#formPublicacion").on('submit', function (e) {
        e.preventDefault();
        var imagen = $("#input").val();
        if(imagen == ""){
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Debes de seleccionar una imagen',
                showConfirmButton: false,
                timer: 1500
              })
        }
    });
    document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });
            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();
            $progress.show();
            $alert.removeClass('alert-success alert-warning');
            canvas.toBlob(function (blob) {
                var formData = new FormData();

                formData.append('avatar', blob, 'avatar.jpg'); //envio de la imagen
                formData.append('opcion', 'crearPublicacion'); //Añadir POST
                // formData.append('opcion', 'modificarFotoPerfil'); //Añadir POST
                $("#avatar").show();
                $("#formPublicacion").on('submit', function (e) {
                    e.preventDefault();
                    let titulo = $("#titulo").val();
                    let descripcion = $("#descripcion").val();

                    formData.append('titulo', titulo); //Añadir POST
                    formData.append('descripcion', descripcion); //Añadir POST
                    if (titulo == "" || titulo.length < 12) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Es titulo es demaciado corto',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (descripcion == "" || descripcion.length < 12) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'La descripción es demaciado corta',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
                                        percent = Math.round((e.loaded / e.total) * 100);
                                        percentage = percent + '%';
                                        $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                    }
                                };

                                return xhr;
                            },

                            success: function (response) {
                                $alert.show().addClass('alert-success').text('Perfil actualizado');
                                console.log(response);
                            },

                            error: function (xhr, status) {
                                console.log(xhr.responseText);
                                avatar.src = initialAvatarURL;
                                $alert.show().addClass('alert-warning').text('Error al realizar el cambio');
                            },
                            complete: function () {
                                $progress.hide();
                            },
                        });
                    }

                })
            });
        }
    });
});