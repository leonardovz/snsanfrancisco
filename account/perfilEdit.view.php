<?php
$CROOPER = true;
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="md-form form-sm text-center">
                            <input type="text" id="nombreEmpresa" class="form-control form-control-sm">
                            <label for="nombreEmpresa">Nombre de tu empresa, o compañia</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form form-sm">
                                    <i class="fas fa-tty prefix"></i>
                                    <input type="text" id="telOficina" class="form-control form-control-sm">
                                    <label for="telOficina">Telefono oficina</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form form-sm">
                                    <i class="fas fa-phone-square prefix text-success"></i>
                                    <input type="text" id="celContacto" class="form-control form-control-sm">
                                    <label for="celContacto">No. Celular de Contacto</label>
                                </div>
                            </div>
                        </div>
                        <div class="md-form form-sm">
                            <i class="fas fa-home prefix"></i>
                            <input type="password" id="domicilio" class="form-control form-control-sm">
                            <label for="domicilio">Domicilio</label>
                        </div>
                        <div class="form-group">
                            <label for="">Selecciona tu servicio</label>
                            <select class="pl-5 browser-default custom-select form-control select2">
                                <option value="0" selected>Selecciona...</option>
                                <option value="1">Panaderia</option>
                                <option value="2">Licoreria</option>
                                <option value="3">Estilista</option>
                                <option value="4">Peloqueria</option>
                                <option value="5">Peloqueria</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="whatsapp">
                                    <label class="custom-control-label" for="whatsapp"> <i class="fab fa-whatsapp text-success"></i> Activar whatsApp</label>
                                </div>
                            </div>
                        </div>
                        <div class="md-form form-sm">
                            <i class="fa fa-pencil-alt prefix"></i>
                            <textarea type="text" id="materialFormMessageModalEx1" class="md-textarea form-control"></textarea>
                            <label for="materialFormMessageModalEx1">Aquí describe el trabajo que realizas (descripcion)</label>
                        </div>
                        <div class="text-center mt-4 mb-2">
                            <button class="btn btn-primary">Guardar mi configuración
                                <i class="fa fa-send ml-2"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
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
                                    <a class="activator waves-effect mr-4"><i class="fas fa-share-alt white-text"></i></a>
                                    <a class="activator waves-effect mr-4 text-primary" id="editarFoto"><i class="fas fa-edit"></i></a>
                                    <a class="activator waves-effect mr-4 text-danger"><i class="fas fa-trash-alt"></i></i></a>
                                </div>

                            </div>
                            <!-- Card Dark -->
                        </div>
                        <div class="col-md-8">
                            <form id="formEditPerfil" class="text-center border border-light p-5" action="#!">

                                <p class="h4 mb-4"><?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></p>

                                <p>Aquí puedes modificar los datos de tu perfil.</p>
                                <!-- Nombre -->
                                <input type="text" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $UserLogin['nombre']; ?>">
                                <!-- Apellidos -->
                                <input type="text" id="apellidos" class="form-control mb-4" placeholder="Apellidos" value="<?php echo $UserLogin['apellidos']; ?>">
                                <!-- Sign in button -->
                                <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>
                            </form>
                        </div>
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
                        <h5 class="modal-title" id="modalLabel">Crop the image</h5>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
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
                            $("#paqueteActivo").html(planActivo(data));
                        } else {
                            $("#planInactivo").show();
                        }
                    } else {
                        $("#planInactivo").show();
                    }
                }
            });
            $.ajax({
                type: "POST",
                url: ruta + 'php/usuariosFunciones.php',
                dataType: "json",
                data: 'opcion=membresias',
                error: function(xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    console.log(data);
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

                });
                // let descripcion = $(this).parent().parent().parent().parent().siblings();
                // if (descripcion.is(':visible')) {
                //     descripcion.hide();
                //     opcionMostrar.html('Mostrar <i class="fas fa-arrow-circle-down"></i>').removeClass('warning-color').addClass('default-color');
                // } else {
                //     opcionMostrar.html('Ocultar <i class="fas fa-arrow-circle-up"></i>').removeClass('default-color').addClass('warning-color');
                //     descripcion.show();
                // }
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
                            <h5 class="card-title">Ultimo plan activado: <span>${data.ultimaMembresia.rol}</span></h5>
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
                            <p class="card-text text-white"><span class="h6 mr-2">Plan: </span> <i class="fas fa-money-bill-wave"> </i> ${membresias[i].rol} <span class="ml-3"></span></p>
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

            function listadoPlanes() {

            }
            $(".select2").select2();
        });
    </script>

</body>

</html>