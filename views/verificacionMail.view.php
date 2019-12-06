<?php require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br><br>
    </header>
    <?php if (isset($rutas[1]) && !empty($rutas[1])) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Jumbotron -->
                    <div class="jumbotron text-center my-5">

                        <!-- Title -->
                        <h2 class="card-title h2"><?php echo $systemName; ?> </h2>
                        <!-- Subtitle -->
                        <p class="blue-text my-4 font-weight-bold">Para iniciar Sesión es necesario continuar con la validación </p>

                        <!-- Grid row -->
                        <div class="row d-flex justify-content-center">

                            <!-- Grid column -->
                            <div class="col-xl-7 pb-2">

                                <p class="card-text">Para asegurarnos de que seas tu, es necesario que ingreses nuevamente tu correo electronico Registrado</p>
                                <p><b>Tu código es: </b> <?php echo $rutas[1]; ?></p>
                            </div>
                            <div class="col-md-7">
                                <form id="formVerificar" class="text-center" style="color: #757575;" action="#!">

                                    <!-- Email -->
                                    <div class="md-form">
                                        <input type="hidden" id="codVerificacion" value="<?php echo $rutas[1]; ?>" style="display:none;">
                                        <input type="email" id="correoVerificar" class="form-control">
                                        <label for="correoVerificar">Ingresa tu correo</label>
                                    </div>
                                    <button class="btn btn-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" id=>Validar Correo Electronico</button>
                                </form>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <hr class="my-4">

                        <div class="pt-2">
                            <a href="<?php echo $ruta; ?>" type="button" class="btn btn-blue waves-effect">Volver <span class="fas fa-home ml-1"></span></a>
                            <!-- <a href="<?php echo $ruta; ?>planes" type="button" class="btn btn-outline-primary waves-effect">Validar mi cuenta <i class="fas fa-download ml-1"></i></a> -->
                        </div>

                    </div>
                    <!-- Jumbotron -->
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Jumbotron -->
                    <div class="jumbotron text-center my-5">

                        <!-- Title -->
                        <h2 class="card-title h2"><?php echo $systemName; ?> </h2>
                        <!-- Subtitle -->
                        <p class="blue-text my-4 font-weight-bold">Para continuar con la validacion es necesario contar con un codigo de verificación</p>

                        <!-- Grid row -->
                        <div class="row d-flex justify-content-center">

                            <!-- Grid column -->
                            <div class="col-xl-7 pb-2">
                                <p class="card-text">¿Aún no recibes tu código?</p>
                            </div>
                            <div class="col-md-7">
                                <form id="formSendVerificar" class="text-center" style="color: #757575;" action="#!">

                                    <!-- Email -->
                                    <div class="md-form">
                                        <input type="email" id="materialLoginFormEmail" class="form-control">
                                        <label for="materialLoginFormEmail">Ingresa tu correo</label>
                                    </div>
                                    <button class="btn btn-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Reenviar Correo de Verificación</button>
                                </form>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <hr class="my-4">

                        <div class="pt-2">
                            <a href="<?php echo $ruta; ?>" type="button" class="btn btn-outline-primary waves-effect">Volver <i class="fas fa-home ml-1"></i></a>
                            <!-- <a href="<?php echo $ruta; ?>registro" type="button" class="btn btn-blue waves-effect">Registrarme <span class="far fa-gem ml-1"></span></a> -->
                        </div>

                    </div>
                    <!-- Jumbotron -->
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    require_once 'templates/footer.view.php';
    require_once 'templates/footer.php';
    ?>

    <script>
        var ruta = ruta();
        $(document).ready(function() {
            $("#formVerificar").on('submit', function(e) {
                e.preventDefault();
                let correo = $("#correoVerificar").val();
                let codVerificacion = $("#codVerificacion").val();
                if (correo != "") {
                    var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
                    if (expresion.test(correo)) {
                        $.ajax({
                            type: 'POST',
                            url: ruta + 'php/usuariosAJAX.php',
                            data: 'opcion=verificacion&email=' + correo + '&codVerificacion=' + codVerificacion,
                            dataType: 'json',
                            error: function(xhr, status) {
                                console.log(JSON.stringify(xhr));
                            },
                            success: function(data) {
                                console.log(data);
                                if (data.respuesta == 'exito') {
                                    alertaSwal(data.Texto, 'success');
                                    location.reload();
                                } else {
                                    alertaSwal(data.Texto, 'error', 3000);

                                }
                                // console.log(data);
                            }

                        });
                    } else {
                        alertaSwal('El correo electronico que has ingresado no esta escrito de forma correcta', 'error');
                    }
                } else {
                    alertaSwal('Es necesario que introduzcas tu correo electronico', 'error');
                }
                // alert("HOLA que hace");
            })
        });
    </script>
</body>

</html>