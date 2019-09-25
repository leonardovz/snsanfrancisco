<?php require_once 'templates/header.php';?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php';?>

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
                        <form id="formLogin" class="text-center " style="color: #757575;" action="<?php echo $ruta;?>perfil">

                            <!-- Email -->
                            <div class="md-form">
                                <input type="email" id="correo"  name="correo" class="form-control">
                                <label for="correo">Correo</label>
                            </div>

                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" id="password" name="password"  class="form-control">
                                <label for="password">Contraseña</label>
                            </div>

                            <div class="d-flex justify-content-around">
                                <div>
                                    <!-- Forgot password -->
                                    <a href="">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>

                            <!-- Sign in button -->
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                type="submit">Ingresar</button>

                            <!-- Register -->
                            <p>¿No eres miembro?
                                <a href="<?php echo $ruta;?>registro">Registrate</a>
                            </p>

                            <!-- Social login -->
                            <p>Inicia Sesión con :</p>
                            <a type="button" class="btn btn-primary text-white text-center"> 
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a type="button" class="btn btn-danger text-white text-center"> 
                                <i class="fab fa-google"></i>
                            </a>

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
    <?php require_once 'templates/footer.view.php';?>

    <!-- Footer -->
  <?php require_once 'templates/footer.php';?>
  <script src="<?php echo $ruta;?>script/login.js"></script>
</body>

</html>