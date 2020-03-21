<?php
$acStyles = true;
$systemName = "Servicios | " . $systemName;
require_once 'templates/header.php';
?>

<body>
    <!-- Main navigation -->
    <header>
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <!-- Navbar -->
        <!-- Full Page Intro -->
        <div class="view" style="background-image: url('<?php echo $ruta; ?>recursos/img/servicios/slide-07.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-indigo-strong d-flex justify-content-center align-items-center">
                <!-- Content -->
                <div class="container">
                    <!--Grid row-->
                    <div class="row pt-lg-5 mt-lg-5">
                        <!--Grid column-->
                        <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left wow fadeInLeft" data-wow-delay="0.3s">
                            <h1 class="display-4 font-weight-bold"><?php echo $systemName; ?></h1>
                            <hr class="hr-light">
                            <h6 class="mb-3">Subscribete a las noticias y nuevas publicaciónes de nuestros Usuarios. Resuelve todas tus inquietudes, envianos tus dudad y sugerencias! estamos para atenderte!

                            </h6>
                            <a href="<?php echo $ruta; ?>acercade" class="btn btn-outline-white">Leer Más</a>
                        </div>
                        <div class="col-md-6 col-xl-5 mb-4">

                            <!--Form-->
                            <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?php echo $ruta; ?>recursos/img/servicios/CC_slide_05.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo $ruta; ?>recursos/img/servicios/CC_slide_06.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo $ruta; ?>recursos/img/servicios/CC_slide_07.png" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.Form-->
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </div>
                <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-5 mt-5 bl-2">
                <h2>Nuevos Servicios Registrados!</h2>
            </div>
        </div>
        <div class="row justify-content-center" id="serviciosSystem">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="my-5">
            <div class="row">
                <div class="col-md-12 p-4">
                    <h1></h1>
                    <h3>Publicaciones</h3>
                </div>
            </div>
            <div class="row justify-content-center" id="publicacionesBody">
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col my-5">
                    <?php if (isset($ADSENSE) && $ADSENSE) { ?>
                        <script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-4">
                    <h3>Empresas</h3>
                </div>
            </div>
            <div class="row justify-content-center" id="cuerpoPerfiles">
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col my-5">
                    <?php if (isset($ADSENSE) && $ADSENSE) { ?>s
                    <script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <?php } ?>
                </div>
            </div>
        </section>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script src="<?php echo $ruta; ?>script/servicios.js"></script>
</body>

</html>