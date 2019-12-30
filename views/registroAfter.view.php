<?php require_once 'templates/header.php'; ?>


<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container ripe-malinka-gradient rounded shadow"><br>
        <div class="row justify-content-center pb-4">
            <div class="col-12">
                <img src="<?php echo $ruta; ?>galeria/sistema/banners/verificacion.png" alt="" style="width: 100%;">
            </div>
            <div class="col-md-6 text-justify text-white">
                <h3 class="h1">Es momento de verificar tu cuenta</h3>
                <br>
                <p>Se ha enviado un correo electronico con la confirmación de tu cuenta, es necesario que accedas a tu bandeja de mensajes, o a la carpeta de spam, y verifiques tu correo </p>
                <p>Una vez, finalizado tu registro estas listo para continuar y comenzar a configurar tu cuenta</p>

                <p>Si no te llego el correo de confirmación puedes reenviarlo en el apartado de <b><a class="text-white" href="<?php echo $ruta; ?>/verificar">Verificación</a></b></p>
                <p>Recuerda que tienes los enlaces para contacto directo, en nuestras redes sociales</p>
                <a class="text-white" href="<?php echo $ruta; ?>/verificar">Verificación</a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php require_once 'templates/footer.view.php'; ?>

    <?php require_once 'templates/footer.php'; ?>
</body>

</html>