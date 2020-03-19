<?php
$BUSQUEDAAC = explode("-", $RUTAS1)[0];
$BUSQUEDAAC = ($BUSQUEDAAC == 'busqueda') ? str_replace("-", " ", substr($RUTAS1, (9))) : false;
$PAGINACION = explode("-", $RUTAS2);
$pagina = isset($PAGINACION[1]) ? (int) $PAGINACION[1] : 0;
$PAGINACION = ($PAGINACION[0] == 'pagina') ? $pagina : 0;
$systemName = "Blog | " . $systemName;
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