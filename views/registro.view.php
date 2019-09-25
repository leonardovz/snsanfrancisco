<?php require_once 'templates/header.php'; ?>


<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container"><br>
        <div class="row">
            <div class="col-md-6 m-auto">
                <!-- Card -->
                <div class="card">

                    <!-- Card body -->
                    <h5 class="card-header info-color-dark white-text text-center py-4 m-0">
                        <strong>Registro</strong>
                    </h5>
                    <div class="card-body">

                        <!-- Material form register -->
                        <form id="formRegistro" method="post"> 
                            <!-- Material input text -->
                            <div class="md-form">
                                <input type="text" id="nombre" name="nombre" class="form-control">
                                <label for="nombre" class="font-weight-light">Tu nombre</label>
                            </div>
                            <div class="md-form">
                                <input type="text" id="apellido" name="apellido" class="form-control">
                                <label for="apellido" class="font-weight-light">Tu apellido</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <input type="email" id="email" name="email" class="form-control">
                                <label for="email" class="font-weight-light">Tu correo</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <!-- <i class="fa fa-exclamation-triangle prefix orange-text"></i> -->
                                <input type="email" id="emailR" name="emailR" class="form-control">
                                <label for="emailR" class="font-weight-light">Confirma tu
                                    correo</label>
                            </div>

                            <!-- Material input password -->
                            <div class="md-form">
                                <!-- <i class="fa fa-lock prefix blue-text"></i> -->
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="password" class="font-weight-light">Ingresa una
                                    contraseña</label>
                            </div>
                            <div class="md-form">
                                <!-- <i class="fa fa-exclamation-triangle prefix orange-text"></i> -->
                                <input type="password" name="passwordR" id="passwordR" class="form-control">
                                <label for="passwordR" class="font-weight-light">Repite tu
                                    contraseña</label>
                            </div>

                            <div class="text-center py-4 mt-3">
                                <button class="btn btn-cyan" type="submit">Register</button>
                            </div>

                            <div class="text-center py-4 mt-0">
                                <!-- Register -->
                                <p>Ya eres miembro?
                                    <a href="<?php echo $ruta; ?>login">Ingresa</a>
                                </p>

                                <!-- Social login -->
                                <p>Inicia Sesión con :</p>
                                <a type="button" class="btn btn-primary text-white text-center">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a type="button" class="btn btn-danger text-white text-center">
                                    <i class="fab fa-google"></i>
                                </a>
                            </div>

                        </form>
                        <!-- Material form register -->

                    </div>
                    <!-- Card body -->

                </div>
                <div class="card">
                    <div class="card-body" id="errores">
                    
                    </div>
                    <!-- Card body -->

                </div>
                <!-- Card -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Footer -->
    <?php require_once 'templates/footer.view.php'; ?>

    <?php require_once 'templates/footer.php'; ?>
    <script src="<?php echo $ruta;?>script/registro.js"></script>
</body>

</html>