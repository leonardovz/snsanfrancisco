<?php
$CROOPER = true;

$conexion = conexion($bd_config);
$FUNCIONES = new AdminFunciones();
$FUNCIONES->CONEXION = $conexion;

$PERFIL = $FUNCIONES->verificarPerfil($UserLogin['idUsuario']); //configuraci[on del perfil]
$SERVICIO = false;
$SOCIALES = false;
if ($PERFIL) {
    $PERFIL = $PERFIL->fetch_assoc();
    $SERVICIO = $FUNCIONES->verificarServicio($PERFIL['idServicio']);
    $SOCIALES = json_decode($PERFIL['social'], true);
    if ($SERVICIO) {
        $SERVICIO = $SERVICIO->fetch_assoc();
    }
}
require_once 'templates/header.php'; ?>

<body>
    <style>
        .label {
            cursor: pointer;
        }

        .progress {
            display: none;
        }

        .alert {
            display: none;
        }

        .img-container img {
            max-width: 100%;
        }
    </style>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="magazine-section my-5">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Card Dark -->
                            <div class="card">
                                <div class="view overlay">
                                    <label class="label" data-toggle="tooltip" title="Change your avatar" style="width: 100%;">
                                        <img class="rounded" id="avatar" src="<?php echo fotoPerfil($UserLogin, $ruta); ?>" alt="avatar" style="width: 100%;">
                                        <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                                    </label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div class="alert" role="alert"></div>
                                </div>
                                <div class="card-body elegant-color white-text rounded-bottom">
                                    <!-- <a class="activator waves-effect mr-4"><i class="fas fa-share-alt white-text"></i></a> -->
                                    <a class="activator waves-effect mr-4 text-primary" id="editarFoto"><i class="fas fa-edit"></i></a>
                                </div>

                            </div>
                            <!-- Card Dark -->
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col">
                                    <form id="formEditPerfil" class="text-center border border-light p-5">

                                        <p class="h4 mb-4"><?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></p>

                                        <p>Aquí puedes modificar los datos de tu perfil.</p>
                                        <!-- Nombre -->
                                        <input type="text" name="nombre" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $UserLogin['nombre']; ?>">
                                        <!-- Apellidos -->
                                        <input type="text" name="apellidos" id="apellidos" class="form-control mb-4" placeholder="Apellidos" value="<?php echo $UserLogin['apellidos']; ?>">
                                        <!-- Sign in button -->
                                        <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-3">
                                    <?php if ($PERFIL) { ?>
                                        <form id="formSocialNetwork" class="text-center border border-light p-md-5 p-3">
                                            <p class="h4 mb-4">Redes Sociales</p>
                                            <p>Modifica los datos de contacto.</p>
                                            <!-- Nombre -->
                                            <div class="row" id="facebookCont" style="display:none;">
                                                <div class="col-xl-1 col-md-2 col-2 text-center pt-2">
                                                    <a target="_blank" href="https://www.facebook.com/snsanfrancisco" class="py-2 px-2 bg-primary rounded"><i class="fab fa-facebook-f text-white"></i></a>
                                                </div>
                                                <div class="col-xl-10 col-md-9 col-9">
                                                    <input type="text" name="facebookVal" id="facebookVal" class="form-control mb-4" placeholder="p. ej. : snsanfrancisco" value="<?php echo ($SOCIALES && isset($SOCIALES['facebook'])) ? $SOCIALES['facebook'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="row" id="instagramCont" style="display:none;">
                                                <div class="col-xl-1 col-md-2 col-2 text-center pt-2">
                                                    <a target="_blank" href="https://www.instagram.com/snsanfrancisco/" class="py-2 px-2 purple-gradient rounded"><i class="fab fa-instagram text-white"></i></a>
                                                </div>
                                                <div class="col-xl-10 col-md-9 col-9">
                                                    <input type="text" name="instagramVal" id="instagramVal" class="form-control mb-4" placeholder="p. ej. : snsanfrancisco" value="<?php echo ($SOCIALES && isset($SOCIALES['instagram'])) ? $SOCIALES['instagram'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="row" id="messengerCont" style="display:none">
                                                <div class="col-xl-1 col-md-2 col-2 text-center pt-2">
                                                    <a target="_blank" href="http://m.me/snsanfrancisco" class="py-2 px-2 bg-info rounded"><i class="fab fa-facebook-messenger text-white"></i></a>
                                                </div>
                                                <div class="col-xl-10 col-md-9 col-9">
                                                    <input type="text" name="messengerVal" id="messengerVal" class="form-control mb-4" placeholder="p. ej. : snsanfrancisco" value="<?php echo ($SOCIALES && isset($SOCIALES['messenger'])) ? $SOCIALES['messenger'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="row" id="whatsappCont">
                                                <div class="col-xl-1 col-md-2 col-2 text-center pt-2">
                                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=523481016176" class="py-2 px-2 bg-success rounded"><i class="fab fa-whatsapp text-white"></i></a>
                                                </div>
                                                <div class="col-xl-10 col-md-9 col-9">
                                                    <input type="text" name="whatsappVal" id="whatsappVal" class="form-control mb-4" placeholder="p. ej. : 3481016176" value="<?php echo ($SOCIALES && isset($SOCIALES['whatsapp'])) ? $SOCIALES['whatsapp'] : "" ?>">
                                                </div>
                                            </div>
                                            <div class="row" id="webCont" style="display:none;">
                                                <div class="col-xl-1 col-md-2 col-2 text-center pt-2">
                                                    <a target="_blank" href="https://snsanfrancisco.com/" class="py-2 px-2 bg-dark rounded"><i class="fas fa-laptop-code text-white"></i></a>
                                                </div>
                                                <div class="col-xl-10 col-md-9 col-9">
                                                    <input type="text" name="webVal" id="webVal" class="form-control mb-4" placeholder="p. ej. : snsanfrancisco.com" value="<?php echo ($SOCIALES && isset($SOCIALES['personalWeb'])) ? $SOCIALES['personalWeb'] : "" ?>">
                                                </div>
                                            </div>
                                            <!-- Apellidos -->
                                            <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>
                                        </form>
                                    <?php } ?>
                                    <button class="btn btn-info" id="cambioPassword" type="submit">Cambiar Contraseña</button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6" style="display:none;">
                            <form id="formCambiarPass" class="text-center border border-light p-5">
                                <input type="text" name="passwordAC" id="password" class="form-control mb-4" placeholder="Contraseña Actual">
                                <input type="text" name="password" id="passwordNew" class="form-control mb-4" placeholder="Nueva Contraseña">
                                <input type="text" name="passwordR" id="passwordNewR" class="form-control mb-4" placeholder="Repite tu nueva Contraseña">
                                <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>
                            </form>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6" id="errorPassword"></div>
                    </div>
                    <div class="row mt-5 justify-content-center" id="contenedorCodigosDisp">
                        <!-- Aqui aparecen codigos en caso de existir -->
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-8 text-center" id="planInactivo" style="display: none;">
                            <p class="note note-primary"><strong>Nota:</strong> No tienes ningun Plan activo puedes ir a <strong><a href="<?php echo $ruta; ?>planes">Registrar</a></strong> un plan para continuar con la verificación de tu servicio.</p>
                            <a href="<?php echo $ruta; ?>planes" class="btn btn-primary"> REGISTRAR PAQUETE </a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-12" id="paqueteActivo">
                            <div class="progress" id="progresoPub">
                                <div id="progresoPubBarra" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="10" aria-valuemax="100">10%</div>
                            </div>
                        </div>
                        <div class="col-md-8" id="paquetesAnteriores">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Cambia tu imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="crop">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>

    <script src="<?php echo $ruta; ?>/script/perfil.js"></script>
    <script>
        $(document).ready(function() {
            var statusCP = false;
            $.ajax({
                type: "POST",
                url: ruta + 'php/usuariosFunciones.php',
                dataType: "json",
                data: 'opcion=miMembresia',
                error: function(xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if (data.respuesta == 'exito') {
                        if (data.planActivo) {
                            if (data.ultimaMembresia) {
                                let membresia = data.ultimaMembresia;
                                if (parseInt(membresia.cobro) > 800) {
                                    $("#whatsappCont").show();
                                    $("#messengerCont").show();
                                    $("#facebookCont").show();
                                    $("#instagramCont").show();
                                    $("#webCont").show();
                                } else if (parseInt(membresia.cobro) > 500) {
                                    $("#whatsappCont").show();
                                    $("#messengerCont").show();
                                    $("#facebookCont").show();
                                    $("#instagramCont").remove();
                                    $("#webCont").remove();
                                } else if (parseInt(membresia.cobro) > 120) {
                                    $("#whatsappCont").show();
                                    $("#messengerCont").remove();
                                    $("#facebookCont").remove();
                                    $("#instagramCont").remove();
                                    $("#webCont").remove();
                                } else {
                                    $("#formSocialNetwork").remove();
                                }
                            }
                            $("#paqueteActivo").html(planActivo(data));
                        } else {
                            $("#formSocialNetwork").remove();
                        }
                    } else {
                        $("#formSocialNetwork").remove();
                    }
                }
            });
            $("#formSocialNetwork").on('submit', function(e) {
                e.preventDefault();
                var formulario = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: ruta + 'php/usuariosFunciones.php',
                    dataType: "json",
                    data: 'opcion=redesSociales&' + formulario,
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.respuesta == 'exito') {
                            Swal.fire(
                                '¡Exito!',
                                data.Texto,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                '¡ERROR!',
                                data.Texto,
                                'error'
                            )
                        }
                    }
                });
            })

            $.ajax({
                type: "POST",
                url: ruta + 'php/usuariosFunciones.php',
                dataType: "json",
                data: 'opcion=membresias',
                error: function(xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if (data.respuesta == 'exito') {
                        if (data.membresias.length > 0) {
                            var titulo = `<h2>Tu historial de membresias</h2>`;
                            $("#paquetesAnteriores").html(titulo + planInactivo(data.membresias));
                            configurarPerfilEmpresa();
                        }
                    } else {
                        var cuerpo = `

                        `;
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: ruta + 'php/usuariosFunciones.php',
                dataType: "json",
                data: 'opcion=codigos',
                error: function(xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    if (data.respuesta == 'exito') {
                        let cuerpo = "";
                        cuerpo += `
                            <div class="col-12 my-3">
                                    <b class="h5 p-3 "> Tienes algunos códigos sin activar</b>
                            </div>`;
                        for (const i in data.codigos) {
                            paquete = data.codigos[i];
                            cuerpo += `
                            <div class="col-md-5 col-sm-8 col-12">
                                <div class="card testimonial-card">
                                    <div class="card-body">
                                        <p class="card-title">Codigo: <b>${paquete.codigo}</b></p>
                                        <hr>
                                        <p>Paquete: <i class="fas fa-quote-left ml-2"></i><b class="mx-2">${paquete.nombre} </b> - <b class="mx-2">${paquete.tipo}</b>  <i class="fas fa-quote-right"></i></p>
                                        <hr>
                                        <p> Cantidad: <b>${paquete.cantidad}</b></p>
                                        <a href="${ruta}planes/${paquete.idRango}" class="btn unique-color text-white btn-sm">Activar</a>
                                    </div>
                                </div>
                            </div>
                            `;

                        }
                        $("#contenedorCodigosDisp").html(cuerpo);
                    } else {
                        var cuerpo = `

                        `;
                    }
                }
            });
            $("#formEditPerfil").on('submit', function(e) {
                e.preventDefault();
                var formulario = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: ruta + 'php/usuariosFunciones.php',
                    dataType: "json",
                    data: 'opcion=modificarPerfil&' + formulario,
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
                        if (data.respuesta == "exito") {
                            alertaSwal(data.Texto, 'success');
                        } else {
                            alertaSwal(data.Texto, 'error');
                        }
                    }
                });
            });
            $("#cambioPassword").on('click', function(e) {
                e.preventDefault();
                $("#formCambiarPass").parent().show();
                $("#formCambiarPass").on('submit', function(e) {
                    e.preventDefault();
                    var $formulario = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: ruta + 'php/usuariosFunciones.php',
                        dataType: "json",
                        data: 'opcion=changePassword&' + $formulario,
                        error: function(xhr, resp) {
                            console.log(xhr.responseText);
                        },
                        success: function(data) {
                            if (data.respuesta == "exito") {
                                alertaSwal(data.Texto, "success", 2000);
                                $("#formCambiarPass").parent().hide();

                            } else {
                                alertaSwal(data.Texto, "error", 2000);
                            }
                        }
                    });
                });
            });

            function configurarPerfilEmpresa() {
                var formulario = $("#formEditPerfil");
                formulario.parent().parent().parent().append(`
                <div class="row justify-content-center" id="contenedorConfig">
                    <div class="col-md-6">
                         <button id="configurarCuenta" class="btn btn-primary btn-block "> <i class="fas fa-cog mx-3"></i> Configurar mi cuenta</button>
                    </div>
                </div>
               `);
                $("#configurarCuenta").on('click', function() {
                    $.ajax({
                        type: "POST",
                        url: ruta + 'php/usuariosFunciones.php',
                        dataType: "json",
                        data: 'opcion=misDatos',
                        error: function(xhr, resp) {
                            console.log(xhr.responseText);
                        },
                        success: function(data) {
                            if (data.respuesta == 'exito') {
                                let cuerpo =
                                    `
                                        <div class="row justify-content-center" >
                                            <div class="col-md-8">
                                                <form id="formRegistroServicio" class="text-center" style="color: #757575;">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <!-- First name -->
                                                            <div class="md-form">
                                                                <input type="text" id="nombreServicio" name="nombreServicio" class="form-control" value="${data.perfil.nombreServicio}">
                                                                <label for="nombreServicio" class="active">Nombre de tu empresa, o compañia</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- E-mail -->
                                                    <div class="md-form mt-0">
                                                        <input type="email" id="correoServicio" name="correoServicio" class="form-control" value="${data.perfil.correoServicio}">
                                                        <label for="correoServicio" class="active" >Correo de contacto</label>
                                                    </div>
                                                    <div class="form-row">
                                                        <!-- Phone number -->
                                                        <div class="col md-form">
                                                            <input type="number" id="telefonoOficina" name="telefonoOficina" class="form-control" aria-describedby="telefonoOficinaTogle" value="${data.perfil.telefono}" >
                                                            <label for="telefonoOficina" class="active">Telefono oficina</label>
                                                            <small id="telefonoOficinaTogle" class="form-text text-muted mb-4">
                                                                Opcional - Contacto directo
                                                            </small>
                                                        </div>
                                                        <!-- Phone number -->
                                                        <div class="col md-form">
                                                            <input type="number" id="telefonoCelular" name="telefonoCelular" class="form-control" aria-describedby="telefonoOficinaTogle" value="${data.perfil.celular}" >
                                                            <label for="telefonoCelular" class="active">Telefono oficina</label>
                                                            <small id="telefonoOficinaTogle" class="form-text text-muted mb-4">
                                                                Opcional - Contacto directo
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="md-form mt-0">
                                                                <input type="text" id="domicilio" name="domicilio" class="form-control" value="${data.perfil.domicilio}">
                                                                <label for="domicilio" class="active">Domicilio</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="md-form mt-0">
                                                                <input type="number" id="codigoPostal" name="codigoPostal" class="form-control" value="${data.perfil.CP}">
                                                                <label for="codigoPostal" class="active">C.P.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" id="errorCP">
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="md-form mt-0">
                                                                <input type="text" id="estado" class="form-control disabled" style="display:none">
                                                                <!-- <label for="estado">Estado</label> -->
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="md-form mt-0">
                                                                <input type="text" id="municipio" class="form-control disabled" style="display:none">
                                                                <!-- <label for="municipio">municipio</label> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row my-3">
                                                        <div class="col" id="coloniasCont">
                                                            <!-- select nombre de la colonia -->
                                                        </div>
                                                        <div class="col" id="coloniasVal">
                                                            <!-- imput colonia no existe -->
                                                        </div>
                                                    </div>
                                                    <div class="form-row my-3">
                                                        <div class="col">
                                                            <div class="md-form">
                                                                <textarea id="descripcion" name="descripcion"  class="md-textarea form-control" rows="3">${data.perfil.descripcion}</textarea>
                                                                <label for="descripcion" class="active">Descripción del servicio que ofreces</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row my-3">
                                                        <div class="col" id="servicioContent">
                                                        </div>
                                                    </div>
                                                    <div class="form-row my-3">
                                                        <div class="col" id="servicioErrores">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Guardar Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    `;
                                $("#contenedorConfig").removeClass('row');
                                $("#contenedorConfig").html(cuerpo);


                                traerServicios();
                                traerDireccion($("#codigoPostal").val(), data.perfil.colonia);
                                $("#codigoPostal").change(function() {
                                    traerDireccion($(this).val());
                                });

                                $("#formRegistroServicio").on('submit', function(e) {
                                    e.preventDefault();
                                    let formularioSer = $(this).serialize();
                                    registroServicio(formularioSer);
                                });
                            } else {}
                        }
                    });

                });
            }

            function traerServicios() {
                $.ajax({
                    type: "POST",
                    url: ruta + 'php/publicacionesAJAX.php',
                    dataType: "json",
                    data: 'opcion=traerServicios',
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
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
                    }
                });
            }


            function planActivo(data) {
                var fechaInicio = fechaFormato(data.ultimaMembresia.fechaInicio);
                var fechaFinal = fechaFormato(data.ultimaMembresia.fechaFinal);
                fechaInicio = fechaInicio[0] + ' - ' + MESES[fechaInicio[1]] + ' - ' + fechaInicio[2];
                fechaFinal = fechaFinal[0] + ' - ' + MESES[fechaFinal[1]] + ' - ' + fechaFinal[2];
                var tiempoRestante = '';
                if (data.anio >= 1) {

                    tiempoRestante += data.anio + ((data.anio > 1) ? " años" : " año");
                }
                if (data.meses >= 1) {
                    tiempoRestante += ((tiempoRestante != '') ? ", " : "");
                    tiempoRestante += data.meses + ((data.meses > 1) ? " meses" : " mes");
                }
                if (data.dias >= 1) {
                    tiempoRestante += ((tiempoRestante != '') ? ", " : "");
                    tiempoRestante += data.dias + ((data.dias > 1) ? " días" : " día");
                }

                var cuerpo = `
                    <div class="card z-depth-1 mb-3">
                        <div class="card-body primary-color text-white">
                            <h5 class="card-title">Ultimo plan activado: <span>${data.ultimaMembresia.rol} <i class="${data.ultimaMembresia.icono} mx-3"> </i></span></h5>
                            <p class="card-text text-white">Este paquete se tendrá que renovar cada ${data.ultimaMembresia.duracion} mes${((data.ultimaMembresia.duracion>1)?"es":"")}</p>
                            <p class="card-text text-white">Estado del plan:  <b>${((data.planActivo)? "Activo": "Inactivo")} <span class="${((data.planActivo)? "text-success": "text-danger")}"><i class="fas fa-map-marker"></i></span> </b></p>
                            <p class="card-text text-white">Tiempo restante:  <b>${tiempoRestante} </b></p>
                            <a class="card-link">${fechaInicio}</a>
                            <a class="card-link"> /</a>
                            <a class="card-link">${fechaFinal}</a>
                        </div>
                    </div>
                `;
                // var fecha = fechaFormato(data.ultimaMembresia.fechaInicio);
                return cuerpo;
            }

            function planInactivo(membresias) {
                var cuerpo = ``;
                for (var i in membresias) {
                    var fechaInicio = fechaFormato(membresias[i].fechaInicio);
                    var fechaFinal = fechaFormato(membresias[i].fechaFinal);
                    fechaInicio = fechaInicio[0] + ' - ' + MESES[fechaInicio[1]] + ' - ' + fechaInicio[2];
                    fechaFinal = fechaFinal[0] + ' - ' + MESES[fechaFinal[1]] + ' - ' + fechaFinal[2];
                    cuerpo += `
                   <div class="card z-depth-1 mb-3">
                        <div class="card-body default-color-dark text-white">
                            <p class="card-text text-white"><span class="h6 mr-2">Plan: </span> <i class="${membresias[i].icono} mx-3"> </i>${membresias[i].rol} <span class="ml-3"></span></p>
                            <p class="card-text text-white"><span class="h6 mr-2">Duración: </span> ${membresias[i].duracion} mes${((membresias[i].duracion>1)?"es":"")} <i class="fas fa-hourglass-end ml-3"></i></p>
                            <p class="card-text text-white"><span class="h6 mr-2">Costo: </span> $ ${membresias[i].cobro}.00 MXN </p>
                            <a class="card-link">${fechaInicio}</a>
                            <a class="card-link"> / </a>
                            <a class="card-link">${fechaFinal}</a>
                        </div>
                    </div>
                `;
                }

                return cuerpo;
            }

            function traerDireccion(codigoPostal, coloniaActiva = false) {
                var estado = $("#estado");
                var municipio = $("#municipio");
                var colonias = $("#coloniasCont");
                var coloniasImp = $("#coloniasVal");
                $.ajax({
                    type: "POST",
                    url: '<?php echo $ruta; ?>/php/publico.php',
                    dataType: "json",
                    data: "opcion=codigoPostal&CP=" + codigoPostal,
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
                        if (data.respuesta == "exito") {
                            data = data.codigos[0];

                            if (data.estado != "" && data.municipio != "") {
                                statusCP = true;
                                $("#errorCP").html("");
                                estado.val(data.estado);
                                estado.show();
                                municipio.val(data.municipio).show();
                                if (data.colonias.length > 0) {
                                    let opciones = "";
                                    for (const i in data.colonias) {
                                        opciones += `<option value="${data.colonias[i]}" >${data.colonias[i]}</option>`;
                                    }
                                    colonias.html(`<label>Colonia</label>
                                <select class="browser-default custom-select select2" id="colonia"name="colonia">
                                <option value="0">Otra</option>
                                ${opciones}
                                </select>`);
                                    if (coloniaActiva) {
                                        coloniasImp.html(`<div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" id="coloniaText" name="coloniaText" class="form-control" value="${((coloniaActiva)?coloniaActiva:"")}">
                                            <label for="coloniaText" ${((coloniaActiva)?' class="active" ':"")}>Colonia</label>
                                        </div>
                                    </div>`);
                                    }
                                    $("#colonia").change(function() {
                                        let colonia = $(this).val();
                                        if (colonia == 0 || coloniaActiva) {
                                            coloniasImp.html(`<div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" id="coloniaText" name="coloniaText" class="form-control" value="${((coloniaActiva)?coloniaActiva:"")}">
                                            <label for="coloniaText" ${((coloniaActiva)?' class="active" ':"")}>Colonia</label>
                                        </div>
                                    </div>`);
                                        } else {
                                            coloniasImp.html("");
                                        }
                                    });
                                } else if (data.colonias.length == 0 || coloniaActiva) {
                                    coloniasImp.html(`<div class="col">
                                        <div class="md-form mt-3">
                                            <input type="text" id="coloniaText" name="coloniaText" class="form-control" value="${((coloniaActiva)?coloniaActiva:"")}">
                                            <label for="coloniaText" ${((coloniaActiva)?' class="active" ':"")}>Colonia</label>
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
                        }
                    }
                });
            }
            $(".select2").select2();

            function registroServicio(formulario) {
                var errorForm = $("#servicioErrores");
                errorForm.html("");
                var $activacionCode = $("#registroCode").val();
                var colonia = $("#colonia").val();
                var coloniaText = 0;

                var estado = $("#estado");
                var municipio = $("#municipio");
                var colonias = $("#coloniasCont");
                var coloniasImp = $("#coloniasVal");

                var errores = 0;
                if (true) { //|| statusCP
                    if (colonia == 0 && false) {
                        coloniaText = $("#coloniaText").val();
                        if (coloniaText == "" || coloniaText.length < 5) {
                            errorForm.append('<div class="alert alert-warning" role="alert">La colonia que ingreso no es correcta </div>');
                            errores++;
                            alertaSwal('La colonia que ingreso no es correcta', 'error');
                        }
                    }
                } else {
                    errorForm.append('<div class="alert alert-warning" role="alert">Necesitas de ingresar un código postal valido </div>');
                    errores++;
                    alertaSwal('Necesitas de ingresar un código postal valido', 'error');

                }
                errorForm.children().show();
                if (errores == 0) {
                    $.ajax({
                        type: "POST",
                        url: ruta + 'php/usuariosFunciones.php',
                        dataType: "json",
                        data: 'opcion=editarPerfilInfo&' + formulario,
                        error: function(xhr, resp) {
                            console.log(xhr.responseText);
                        },
                        success: function(data) {
                            if (data.respuesta == 'exito') {
                                alertaSwal(data.Texto, 'success');
                            } else {
                                errorForm.append('<div class="alert alert-warning" role="alert">' + data.Texto + ' </div>');
                            }
                        }
                    });
                }

            }
        });
    </script>

</body>

</html>