<?php require_once 'templates/header.php'; ?>


<body>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container"><br>
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <h5 class="card-header info-color-dark white-text text-center py-4 m-0">
                        <strong>¡Registrate!</strong>
                    </h5>
                    <div class="card-body">

                        <form id="formRegistro" method="post">
                            <div class="md-form">
                                <input type="text" id="nombre" name="nombre" class="form-control">
                                <label for="nombre" class="font-weight-light">Nombre</label>
                            </div>
                            <div class="md-form">
                                <input type="text" id="apellido" name="apellido" class="form-control">
                                <label for="apellido" class="font-weight-light">Apellidos</label>
                            </div>

                            <div class="md-form">
                                <input type="email" id="email" name="email" class="form-control">
                                <label for="email" class="font-weight-light">Email</label>
                            </div>

                            <div class="md-form">
                                <input type="email" id="emailR" name="emailR" class="form-control">
                                <label for="emailR" class="font-weight-light">Confirmación de email</label>
                            </div>

                            <div class="md-form">
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="password" class="font-weight-light">Contraseña</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="passwordR" id="passwordR" class="form-control">
                                <label for="passwordR" class="font-weight-light">Repite la contraseña</label>
                            </div>
                            <div class="col-md-12 p-0 mb-5 text-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="terminos-condiciones" name="terminos-condiciones">
                                    <label class="custom-control-label" for="terminos-condiciones">Acepto los <a target="_blank" href="<?php echo $ruta; ?>galeria/documentos/terminos_y_condiciones.pdf">Términos y Condiciones</a></label>
                                </div>
                            </div>
                            <div class="col-md-12 p-0 mb-5">
                                <div class="g-recaptcha" data-sitekey="6LcQ4tQUAAAAAEziLRqunTXdhfs8xNDml7LHKGds"></div>
                            </div>

                            <div class="text-center py-4 mt-3">
                                <button class="btn btn-cyan" type="submit">Registrarme</button>
                            </div>
                            <div class="text-center py-4 mt-0">
                                <p>Ya eres miembro?
                                    <a href="<?php echo $ruta; ?>login">Ingresa</a>
                                </p>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body" id="errores">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Footer -->
    <?php require_once 'templates/footer.view.php'; ?>

    <?php require_once 'templates/footer.php'; ?>
    <script src="<?php echo $ruta; ?>script/registro.js"></script>
</body>

</html>