<?php
require_once 'config/ruta.php';
require_once 'config/config.php';
require_once 'config/funciones.php';
$conexion = conexion($bd_config);

if ($conexion->connect_errno) {
    $respuesta = array(
        'respuesta' => 'error',
        'Texto' => 'Hay un problema al conectar con el servidor'
    );
    die(json_encode($respuesta));
}

$FUNCIONES = new AdminFunciones();
$FUNCIONES->CONEXION = $conexion;
$idPost = ($RUTAS1) ? (int) $RUTAS1 : false;
$SERVICIO = false;

$SERVICIO = $FUNCIONES->verificarServicio($idPost);
if ($SERVICIO) {
    $SERVICIO = $SERVICIO->fetch_assoc();
}

$systemName =  $SERVICIO['nombre'] . ' | ' . $systemName;
$keyWords = $SERVICIO['nombre'] . ' | ' . $keyWords;
$descripcionServ = $descripcionServ . ' - ' . $SERVICIO['nombre'];


// exit;
require_once 'templates/header.php';
?>

<body>
    <header>
        <?php require_once 'templates/header.view.php'; ?>
    </header>
    <br>
    <br>
    <br>
    <br>
    <?php if (!$SERVICIO) { ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <!--Modal: mdb-abandonedCart-hard-->
                    <div class="modal-dialog modal-notify modal-warning" role="document">
                        <!--Content-->
                        <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header">
                                <p class="heading">¿Estas perdid@?</p>
                            </div>

                            <!--Body-->
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-3 text-center">
                                        <img src="<?php echo $ruta; ?>galeria/usuario/00001/perfil_1569612092_00001.jpg" alt="Michal Szymanski - founder of Material Design for Bootstrap" class="img-fluid z-depth-1-half rounded-circle">
                                        <div style="height: 10px"></div>
                                        <p class="title mb-0">Leonardo</p>
                                        <p class="text-muted " style="font-size: 13px">Consultame</p>
                                    </div>

                                    <div class="col-9">
                                        <p>Intentaste ingresar a una Publicacion que no existe, es muy provable que la cuenta se haya dado de baja, o el perfil este bloqueado.</p>
                                        <p class="card-text"><br>
                                            <strong>¿No encuentras tu perfil?</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer justify-content-center flex-wrap">
                                <button type="button" class="btn btn-warning waves-effect waves-light">Necesito Ayuda</button>
                                <a type="button" class="btn btn-outline-warning waves-effect">Quiero volver al Inicio</a>
                            </div>
                        </div>
                        <!--/.Content-->
                    </div>
                </div>
            </div>
        </div>

    <?php
        require_once 'templates/footer.view.php';
        require_once 'templates/footer.php';
        exit;
    } ?>

    <section class="container">
        <!-- Grid row -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-5 col-md-6 col-sm-6 col-12 mb-4 wow fadeInDown">

                <div class="card card-image waves-effect waves-light" style="background-image: url(<?php echo $ruta . 'galeria/sistema/servicios/' . $SERVICIO['imagen']; ?>); background-repeat: no-repeat; background-size: cover;">

                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                        <div>
                            <h5 class="pink-text"><i class="<?php echo $SERVICIO['icono']; ?> mx-3"></i> <?php echo $SERVICIO['nombre']; ?></h5>
                            <h3 class="card-title pt-2"><strong><?php echo $SERVICIO['descripcion']; ?></strong></h3>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-4">
                <h1></h1>
                <h3>Personas encontradas</h3>
            </div>
        </div>
        <div class="row" id="contPersonas">

        </div>
        <div class="row">
            <div class="col-md-12 p-4">
                <h3>Ultimas Publicaciones!</h3>
            </div>
        </div>
        <div class="row" id="contPersonasPub">
            <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
        </div>
        <div class="row">
            <div class="col-md-12 p-5">
                <h3>Nuevos Servicios Registrados!</h3>
            </div>
        </div>
        <div class="row justify-content-center" id="serviciosBody">
        </div>
        <div class="row">
            <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
        </div>
    </section>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        var idServicio = <?php echo $idPost; ?>
    </script>
    <script src="<?php echo $ruta; ?>script/serviciosBusqueda.js"></script>
</body>

</html>