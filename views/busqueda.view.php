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
$BUSCADOR = ($RUTAS1) ? $RUTAS1 : "";
$systemName =  $BUSCADOR . ' | ' . $systemName;
$keyWords = $BUSCADOR . ' | ' . $keyWords;
$descripcionServ = $descripcionServ . ' - ' . $BUSCADOR;


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

    <?php if ($RUTAS2) { ?>
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
                                        <p>Al parecer el enlace que estas intentando acceder no es posible realizar su busqueda.</p>
                                        <p class="card-text"><br>
                                            <strong>Dime, en que te podemos ayudar?</strong>
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
        <div class="row justify-content-center" id="contServicios"></div>

        <div class="row">
            <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
        </div>
    </section>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
    </script>
    <script src="<?php echo $ruta; ?>script/busqueda.js"></script>
</body>

</html>