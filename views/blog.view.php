<?php
$BUSQUEDAAC = explode("-", $RUTAS1)[0];
$BUSQUEDAAC = ($BUSQUEDAAC == 'busqueda') ? str_replace("-", " ", substr($RUTAS1, (9))) : false;
$PAGINACION = explode("-", $RUTAS2);
$pagina = isset($PAGINACION[1]) ? (int) $PAGINACION[1] : 0;
$PAGINACION = ($PAGINACION[0] == 'pagina') ? $pagina : 0;
require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br>
        <br>
        <br>
    </header>

    <div class="container my-5">
        <!-- Section: Group of personal cards -->
        <section class="mt-5">
            <div class="row mt-5">
                <div class="col-md-8 mb-4">
                    <h2 class="section-heading">Más posts</h2>
                    <div class="row justify-content-between" id="paginacion">
                    </div>

                    <div class="row justify-content-between" id="cuerpoPostBlog">
                    </div>
                    <h2 class="section-heading">Más publicaciónes</h2>
                    <div class="row justify-content-between" id="cuerpoPublicaciones">
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="row px-md-3 " id="cuerpoPerfiles">
                        <div class="spinner-grow" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <h3 class="h5">Servicios</h3>
                    <!--Grid row-->
                    <div class="row" id="contServicios">
                        <!--Grid column-->
                        <div class="col-md-12 mb-4">

                            <!-- Card -->
                            <div class="card gradient-card">

                                <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">

                                    <!-- Content -->
                                    <a href="#!">
                                        <div class="text-white d-flex h-100 mask blue-gradient-rgba">
                                            <div class="first-content align-self-center p-3">
                                                <h3 class="card-title">Today's sales</h3>
                                                <p class="lead mb-0">Click on this card to see details</p>
                                            </div>
                                            <div class="second-content align-self-center mx-auto text-center">
                                                <i class="far fa-money-bill-alt fa-3x"></i>
                                            </div>
                                        </div>
                                    </a>

                                </div>

                            </div>
                            <!-- Card -->

                        </div>
                        <!--Grid row-->
                    </div>
                </div>
        </section>
    </div>



    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        var busqueda = '<?php echo $BUSQUEDAAC; ?>';
        var paginaAC = '<?php echo $PAGINACION; ?>';
        var busquedaRuta = 'busqueda<?php echo (($BUSQUEDAAC) ? "-" : "") . str_replace(" ", "-", $BUSQUEDAAC); ?>/';
    </script>
    <script src="<?php echo $ruta; ?>script/blog.js"></script>

</body>

</html>