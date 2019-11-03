$(document).ready(function () {
    var statusCP = false;
    var estado = $("#estado");
    var municipio = $("#municipio");
    var colonias = $("#coloniasCont");
    var coloniasImp = $("#coloniasVal");
    $("#codigoPostal").change(function () {
        traerDireccion($(this).val());
    });
    $("#formRegistroServicio").on('submit', function (e) {
        e.preventDefault();
        var formulario = $(this);
        registroServicio(formulario);
    });
    traerServicios();


    function traerDireccion(codigoPostal) {
        $.ajax({
            type: "GET",
            url: 'https://api-codigos-postales.herokuapp.com/v2/codigo_postal/' + codigoPostal,
            dataType: "json",
            error: function (xhr, resp) {
                console.log(xhr.responseText);
                coloniasImp.html(`<div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="coloniaText" name="coloniaText" class="form-control">
                                    <label for="coloniaText">Colonia</label>
                                </div>
                            </div>`);
            },
            success: function (data) {
                if (data.estado != "" && data.municipio != "") {
                    statusCP = true;
                    $("#errorCP").html("");
                    estado.val(data.estado).show();
                    municipio.val(data.municipio).show();
                    if (data.colonias.length > 0) {
                        let opciones = "";
                        for (const i in data.colonias) {
                            opciones += `<option value="${data.colonias[i]}" >${data.colonias[i]}</option>`;
                        }
                        colonias.html(`<label>Colonia</label>
                        <select class="browser-default custom-select select2" id="colonia"name="colonia">
                        ${opciones}
                            <option value="0">Otra</option>
                        </select>`);
                        $("#colonia").change(function () {
                            let colonia = $(this).val();
                            console.log(colonia);
                            if (colonia == 0) {
                                coloniasImp.html(`<div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="coloniaText" name="coloniaText" class="form-control">
                                    <label for="coloniaText">Colonia</label>
                                </div>
                            </div>`);
                            } else {
                                coloniasImp.html("");
                            }
                        });
                    } else if (data.colonias.length == 0) {
                        coloniasImp.html(`<div class="col">
                                <div class="md-form mt-3">
                                    <input type="text" id="coloniaText" name="coloniaText" class="form-control">
                                    <label for="coloniaText">Colonia</label>
                                </div>
                            </div>`);
                    }
                } else {
                    statusCP = false;
                    $("#errorCP").html(`
                        <div class="alert alert-danger" role="alert">
                            El código postal que ingresaste no se encuentra en nuestra base de datos
                        </div>
                    `);
                    estado.val(data.estado).hide();
                    municipio.val(data.municipio).hide();
                    colonias.html("");
                    coloniasImp.html("");
                }
                console.log(data);
            }
        });
    }

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
                if (data.respuesta == "exito") {
                    let opciones = "";
                    for (const i in data.servicios) {
                        opciones += `<option value="${data.servicios[i].id}" >${data.servicios[i].nombre}</option>`;
                    }

                    $("#servicioContent").html(`<label>Servicios</label>
                        <select class="browser-default custom-select" id="servicio"name="servicio">
                        ${opciones}
                            <option value="0">Otra</option>
                        </select>`);
                    $('#servicio').select2();
                }
                console.log(data);
            }
        });
    }

    function registroServicio(formulario) {
        var errorCodigo = $("#errorCode");
        var errorForm = $("#servicioErrores");
        errorCodigo.html("");
        errorForm.html("");

        var $formulario = formulario.serialize();
        var $activacionCode = $("#registroCode").val();
        var colonia = $("#colonia").val();
        var coloniaText = $("#coloniaText").val();

        var errores = 0;
        if ($activacionCode != "") {
            var expresion = /^[a-zA-Z0-9]*$/;
            if (!expresion.test($activacionCode)) {
                errorCodigo.append('<div class="alert alert-warning" role="alert"> No se permiten caracteres especiales solo números y letras </div>');
                errores++;
            }
        } else {
            errorCodigo.append('<div class="alert alert-warning" role="alert">Necesitas de ingresar un código </div>');
            errores++;
        }
        if (true || statusCP) {
            if (false && colonia == 0) {
                if (coloniaText == "" || coloniaText.length < 5) {
                    errorForm.append('<div class="alert alert-warning" role="alert">La colonia que ingreso no es correcta </div>');
                    errores++;
                }
            }

        } else {
            errorForm.append('<div class="alert alert-warning" role="alert">Necesitas de ingresar un código postal valido </div>');
            errores++;

        }

        if (errores == 0) {
            $.ajax({
                type: "POST",
                url: ruta + 'php/usuariosFunciones.php',
                dataType: "json",
                data: 'opcion=registroServicio&' + $formulario + '&activacionCode=' + $activacionCode + '&idPaquete=' + paquete,
                error: function (xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function (data) {
                    console.log(data);
                    if (data.respuesta == 'exito') {
                        alertaSwal(data.Texto,'success')
                    } else {
                        errorForm.append('<div class="alert alert-warning" role="alert">' + data.Texto + ' </div>');
                    }
                }
            });
        }

    }
});