<?php
$CROOPER = true;
require_once 'config/ruta.php';
require_once 'config/config.php';
require_once 'config/funciones.php';
$conexion = conexion($bd_config);

if ($conexion->connect_errno) {
    $respuesta = array(
        'respuesta' => 'error',
        'Texto' => 'Hay un problema al conectar con el servidor'
    );
    die(json_encode($respuesta));
}
$PAQUETE = ($RUTAS1 && (int) ($RUTAS1)) ? $RUTAS1 : 0;
$sql = "SELECT * FROM rango WHERE id=$PAQUETE AND (tipo ='mensual' OR tipo= 'anual')";
$resultado = $conexion->query($sql);
$PAQUETE = ($resultado && $resultado->num_rows) ? $resultado->fetch_assoc() : false;

require_once 'templates/header.php';

?>

<body>
    <header class="mb-5">
        <?php require_once 'templates/header.view.php'; ?>
        <br><br>
    </header>
    <?php if ($UserLogin && $PAQUETE) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <h2>Activar cuenta con el paquete <b><?php echo $PAQUETE['nombre'] ?> <i class="<?php echo $PAQUETE['icono'] . ' ' . $PAQUETE['iconColor']; ?>  mx-3"></i></b> </h2>
                    <p>Continual con el registro de tu paquete!</p>
                    <p>Y configura tu perfil de servicio:</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 my-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-2 text-center">Plan <?php echo $PAQUETE['tipo'] ?> <?php echo $PAQUETE['nombre'] ?> </h5>
                            <div class="d-flex justify-content-center">
                                <div class="card-circle d-flex justify-content-center align-items-center">
                                    <i class="<?php echo $PAQUETE['icono'] . ' ' . $PAQUETE['iconColor'] ?> " style="font-size: 4em;"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bold my-4 text-center"><?php echo $PAQUETE['costo'] ?>$ <sub class="grey-text" style="font-size: .5em;">mes</sub></h2>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> Registro de Servicio</p>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> <?php echo $PAQUETE['publicacion'] . (($PAQUETE['publicacion'] > 1) ? " publicaciones " : " publicación ") ?></p>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> Registro de Servicio</p>
                        </div>
                    </div>
                    <div class="card my-4">
                        <div class="card-body">

                            <div class="text-center" style="color: #757575;">
                                <div class="form-row">
                                    <h4 class="text-dark">Ingresa un código de activación</h4>
                                    <div class="col">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input type="text" id="registroCode" class="form-control">
                                            <label for="registroCode">Código de activación</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col" id="errorCode">
                                    </div>
                                </div>
                                <a href="#" id="modalHelp">Ayuda</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 my-4">
                    <div class="card">

                        <h5 class="card-header <?php echo $PAQUETE['bgColor'] . ' ' . $PAQUETE['textColor']; ?>  text-center py-4">
                            <strong>¡En hora buena! Continua con el registro de tu servicio</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form id="formRegistroServicio" class="text-center" style="color: #757575;">

                                <div class="form-row">
                                    <div class="col">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input type="text" id="nombreServicio" name="nombreServicio" class="form-control">
                                            <label for="nombreServicio">Nombre de tu empresa, o compañia</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- E-mail -->
                                <div class="md-form mt-0">
                                    <input type="email" id="correoServicio" name="correoServicio" class="form-control">
                                    <label for="correoServicio">Correo de contacto</label>
                                </div>
                                <!-- Phone number -->
                                <div class="md-form">
                                    <input type="number" id="telefonoOficina" name="telefonoOficina" class="form-control" aria-describedby="telefonoOficinaTogle">
                                    <label for="telefonoOficina">Telefono oficina</label>
                                    <small id="telefonoOficinaTogle" class="form-text text-muted mb-4">
                                        Opcional - Contacto directo
                                    </small>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form mt-0">
                                            <input type="text" id="domicilio" name="domicilio" class="form-control">
                                            <label for="domicilio">Domicilio</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="md-form mt-0">
                                            <input type="number" id="codigoPostal" name="codigoPostal" class="form-control">
                                            <label for="codigoPostal">C.P.</label>
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
                                    <div class="col" id="servicioContent">

                                    </div>
                                </div>
                                <div class="form-row my-3">
                                    <div class="col" id="servicioErrores">

                                    </div>
                                </div>
                                <!-- Newsletter -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialRegisterFormNewsletter">
                                    <label class="form-check-label" for="materialRegisterFormNewsletter">Recibir actualizaciónes</label>
                                </div>

                                <!-- Sign up button -->
                                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Registrar mi Servicio</button>

                                <hr>

                                <!-- Terms of service -->
                                <p>Por SnSanfrancisco
                                    <em> revisa tu registro </em> y configura tu perfil
                                    <a href="<?php echo $ruta; ?>terminosdeuso" target="_blank">Terminos del servicio</a>
                            </form>
                            <!-- Form -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } else if ($UserLogin && !$PAQUETE) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-5">
                    <h2>El paquete que has seleccionado es incorrecto </h2>
                    <p>Para obtener esta alguna de estas cuentas ten en cuenta las necesidades o hasta donde quieres llegar</p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron text-center my-5">
                        <h2 class="card-title h2"><?php echo $systemName; ?> </h2>
                        <p class="blue-text my-4 font-weight-bold">Para continuar con el registro es necesario <a href="<?php echo $ruta; ?>login">iniciar Sesión</a></p>
                        <div class="row d-flex justify-content-center">
                            <div class="col-xl-7 pb-2">
                                <p class="card-text">Si aún no tienes una cuenta puedes <a href="<?php echo $ruta; ?>registro">registrarte</a> y continuar con tu compra</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="pt-2">
                            <a href="<?php echo $ruta; ?>planes" type="button" class="btn btn-outline-primary waves-effect">Volver <i class="fas fa-download ml-1"></i></a>
                            <a href="<?php echo $ruta; ?>registro" type="button" class="btn btn-blue waves-effect">Registrarme <span class="far fa-gem ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        var ruta = ruta();
        var paquete = <?php echo $PAQUETE['id']; ?>;
        $(document).ready(function() {
            var statusCP = false;
            var estado = $("#estado");
            var municipio = $("#municipio");
            var colonias = $("#coloniasCont");
            var coloniasImp = $("#coloniasVal");
            $("#codigoPostal").change(function() {
                traerDireccion($(this).val());
            });
            $("#formRegistroServicio").on('submit', function(e) {
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
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
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
                                $("#colonia").change(function() {
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

            function traerServicios(codigoPostal) {
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
                if (statusCP) {
                    if (colonia == 0) {
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
                        error: function(xhr, resp) {
                            console.log(xhr.responseText);
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.respuesta == 'exito') {

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