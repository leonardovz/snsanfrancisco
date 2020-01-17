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
                <!-- Material form login -->
                <div class="card">

                    <h5 class="card-header info-color-dark white-text text-center py-4">
                        <strong>Ingresar</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <!-- Form -->
                        <form id="formLogin" class="text-center " style="color: #757575;" action="<?php echo $ruta; ?>perfil">

                            <!-- Email -->
                            <div class="md-form">
                                <input type="email" id="correo" name="correo" class="form-control">
                                <label for="correo">Correo</label>
                            </div>

                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="password">Contraseña</label>
                            </div>
                            <div class="col-md-12 p-0 mb-5">
                                <div class="g-recaptcha" data-sitekey="6LfTXMQUAAAAAFrpHyGr_-sXZzdaQ4Pgy4Hmjhlg"></div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <a href="<?php echo $ruta?>recuperarCuenta">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Ingresar</button>
                            <p>¿No eres miembro?
                                <a href="<?php echo $ruta; ?>registro">Registrate</a>
                            </p>
                            <!-- <p>Inicia Sesión con :</p> -->
                            <!-- <a id="loginFacebook" class="btn btn-primary text-white text-center">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a id="loginGoogle" class="btn btn-danger text-white text-center">
                                <i class="fab fa-google"></i>
                            </a> -->

                        </form>
                        <!-- Form -->

                    </div>

                </div>
                <!-- Material form login -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Footer -->
    <?php require_once 'templates/footer.view.php'; ?>

    <!-- Footer -->
    <?php require_once 'templates/footer.php'; ?>
    <script src="<?php echo $ruta; ?>script/login.js"></script>
    <script>
        // window.fbAsyncInit = function() {
        //     FB.init({
        //         appId: '440111830243604',
        //         cookie: true,
        //         xfbml: true,
        //         version: 'v5.0'
        //     });

        //     FB.AppEvents.logPageView();

        // };

        // (function(d, s, id) {
        //     var js, fjs = d.getElementsByTagName(s)[0];
        //     if (d.getElementById(id)) {
        //         return;
        //     }
        //     js = d.createElement(s);
        //     js.id = id;
        //     js.src = "https://connect.facebook.net/en_US/sdk.js";
        //     fjs.parentNode.insertBefore(js, fjs);
        // }(document, 'script', 'facebook-jssdk'));
    </script>
</body>

</html>