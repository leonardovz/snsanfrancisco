<?php
$CROOPER = true;
$summernote = true;
$FUNCIONES = new AdminFunciones();
$FUNCIONES->CONEXION = $conexion;
$conexion = conexion($bd_config);

if ($conexion->connect_errno) {
    $respuesta = array(
        'respuesta' => 'error',
        'Texto' => 'Hay un problema al conectar con el servidor'
    );
    die(json_encode($respuesta));
}
$PERFIL = $FUNCIONES->verificarPerfil($UserLogin['idUsuario']); //configuraci[on del perfil]
$SERVICIO = false;
if ($PERFIL) {
    $PERFIL = $PERFIL->fetch_assoc();
    $SERVICIO = $FUNCIONES->verificarServicio($PERFIL['idServicio']);
    if ($SERVICIO) {
        $SERVICIO = $SERVICIO->fetch_assoc();
    }
}



$BUSQUEDAAC = explode("-", $RUTAS2)[0];
$BUSQUEDAAC = ($BUSQUEDAAC == 'busqueda') ? str_replace("-", " ", substr($RUTAS2, (9))) : false;
$PAGINACION = explode("-", $RUTAS3);
$pagina = isset($PAGINACION[1]) ? (int) $PAGINACION[1] : 0;
$PAGINACION = ($PAGINACION[0] == 'pagina') ? $pagina : 0;
require_once 'templates/header.php'; ?>


<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-7">
                <h2 class="h1-responsive font-weight-bold text-center my-5">Bienvenido, <?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></h2>
            </div>
            <?php if ($UserLogin['rol'] == 1) { ?>
                <div class="col-md-5 text-center">
                    <div class="btn-group responsive font-weight-bold text-center my-5">
                        <button class="btn btn-danger btn-lg btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones <span class="ml-2"><i class="fas fa-cog " aria-hidden="true"></i> </span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/servicios"><span class="green-text mr-4"><i class="fab fa-searchengin"></i></span> Servicios</a>
                            <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/codigos"><span class="blue-text mr-4"><i class="fas fa-code-branch"></i></span> Códigos</a>
                            <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/usuarios"><span class="purple-text mr-4"><i class="fas fa-users"></i></span> Usuarios</a>
                            <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/publicaciones"><span class="orange-text mr-4"><i class="fas fa-vote-yea"></i></span> Publicaciones</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">

            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row p-3">
                                <div class="col-md-12  rounded-lg z-depth-1-half">
                                    <div class="row">
                                        <div class="col-12 px-0 opciones">
                                            <label class="label aqua-gradient rounded " data-toggle="tooltip" title="Agregar imagen" style="width: 100%; cursor: pointer;">
                                                <img class="rounded z-depth-3 mt-0 pt-0" id="avatar" src="<?php echo $ruta; ?>galeria/sistema/images/selecciona.png" alt="avatar" style="width: 100%;">
                                                <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                                            </label>
                                            <div class="progress" id="progresoPub">
                                                <div id="progresoPubBarra" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            </div>
                                            <div class="alert" role="alert"></div>
                                        </div>
                                    </div>
                                    <section class="mb-4">
                                        <div class="row">
                                            <div class="col-md-12 mb-md-0 mb-5 ">
                                                <form id="formPublicacion" name="contact-form" action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="md-form mb-0">
                                                                        <input type="text" id="titulo" name="titulo" class="form-control">
                                                                        <label for="titulo" class="">Título</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 opciones">
                                                                    <textarea type="text" id="descripcion" name="descripcion" class="form-control"><?php
                                                                                                                                                    echo '<div class="card">'
                                                                                                                                                        . '<div class="card-body">'
                                                                                                                                                        . '<h5 class="font-weight-bold mb-3">Subtitulo de la publicación</h5>'
                                                                                                                                                        . '<p class="mb-0">Pequeña descripcion</p>'
                                                                                                                                                        . '</div>'
                                                                                                                                                        . '<div class="card-body text-justify">'
                                                                                                                                                        . '<p>Descripción</p>'
                                                                                                                                                        . '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, fuga? Natus beatae amet <b>tempora</b> minus unde nostrum, nam rerum accusantium perferendis a omnis sed porro dicta similique harum aliquam fugit tempore sint voluptas ullam vero. Voluptatibus ipsa unde voluptatem nam consequatur aspernatur, porro tempore ducimus sint dolorum totam. Cumque soluta eum sint incidunt, velit iste reprehenderit accusamus sequi praesentium expedita harum officia pariatur eligendi tenetur ut minus laboriosam at repellendus laudantium a quaerat perspiciatis. Quam quia, vero aliquid eos, esse earum rem distinctio nihil quaerat dolorem consequuntur necessitatibus impedit vitae, soluta sunt iure dolorum officiis inventore nam nemo? Cumque nesciunt facere, ipsum libero praesentium consequatur ab magni temporibus sequi, excepturi saepe unde iure corporis quibusdam sint nemo nostrum quaerat dicta!</p>'
                                                                                                                                                        . '<blockquote class="blockquote mb-0">'
                                                                                                                                                        . '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>'
                                                                                                                                                        . '<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>'
                                                                                                                                                        . '</blockquote>'
                                                                                                                                                        . '</div>'
                                                                                                                                                        . '</div>';
                                                                                                                                                    ?></textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-8">
                                                            <button class="btn btn-primary btn-block" type="submit">Publicar</button>
                                                        </div>
                                                        <div class="col-2">
                                                            <div id="cancelar" class="btn btn-danger btn-block text-center" type="submit"><i class="fas fa-window-close"></i></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="status"></div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-md-5 text-center">
                                    <nav aria-label="Page navigation example" id="paginacion">
                                        <ul class="pagination pg-blue">
                                            <li class="page-item disabled">
                                                <a class="page-link" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link">1</a></li>
                                            <li class="page-item">
                                                <a class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-inline">
                                        <div class="md-form mt-0">
                                            <input class="form-control mr-sm-2 text-dark" type="text" id="inBusquedaPublicacion" placeholder="Buscar" aria-label="Buscar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5" id="cuerpoPublicaciones">
                                <div class="col">
                                    <p>Cargando ... </p>
                                    <div class="progress">
                                        <div id="progressPub" class="progress-bar progress-bar-striped progress-bar-animated unique-color" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" style="width: 3%">
                                            3%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Modifica tu imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="image" src="<?php echo $ruta; ?>galeria/sistema/images/default.png" style="width: 100%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="crop">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        var busqueda = '<?php echo $BUSQUEDAAC; ?>';
        var paginaAC = '<?php echo $PAGINACION; ?>';
        var busquedaRuta = 'busqueda<?php echo (($BUSQUEDAAC) ? "-" : "") . str_replace(" ", "-", $BUSQUEDAAC); ?>/';
    </script>
    <script src="<?php echo $ruta; ?>account/admin/publicaciones/publicacion.js"></script>
    <script>
        $('#descripcion').summernote();
    </script>
</body>

</html>