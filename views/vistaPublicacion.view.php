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
$idPost = ($RUTAS1) ? (int) $RUTAS2 : false;
$sql = "SELECT P.*,U.nombre AS nombreU,U.apellidos, U.img,U.idUsuario,S.nombre,UI.nombreServicio,U.fecha AS fechaU,S.id AS idServicio FROM publicacion AS P ,usuarios as U, usersinfo AS UI,servicios AS S WHERE P.iduser = U.idUsuario AND U.idUsuario = UI.iduser AND UI.idServicio = S.id AND P.id =" . $idPost;
$resultado = $conexion->query($sql);
$PUBLICACION = ($resultado  && $resultado->num_rows) ? $resultado->fetch_assoc() : false;

$NPUB = 0;
$SERVICIO = false;
if ($PUBLICACION) {
    $contador = "SELECT COUNT(*) AS total FROM publicacion AS P ,usuarios as U, usersinfo AS UI,servicios AS S WHERE P.iduser = U.idUsuario AND U.idUsuario = UI.iduser AND UI.idServicio = S.id AND U.idUsuario =" . $PUBLICACION['idUsuario'];
    $NPUB = $conexion->query($contador);
    $NPUB = ($NPUB && $NPUB->num_rows) ? $NPUB->fetch_assoc()['total'] : 0;

    $systemName = $PUBLICACION['nombreServicio'] . ' | ' . $PUBLICACION['titulo'] . ' | ' . $systemName;
    $keyWords = $PUBLICACION['nombre'] . ' | ' . $keyWords;
    $descripcionServ = $descripcionServ . ' - ' . $PUBLICACION['nombreU'] . ' ' . $PUBLICACION['apellidos'] . ' te ofrece su servicio de ' . $PUBLICACION['nombreServicio'];

    $SERVICIO = $FUNCIONES->verificarServicio($PUBLICACION['idServicio']);
    if ($SERVICIO) {
        $SERVICIO = $SERVICIO->fetch_assoc();
    }
}
// var_dump($PUBLICACION);
// exit;
require_once 'templates/header.php';

?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br><br>
    </header>
    <div class="container mt-5">
        <!-- Section: Group of personal cards -->
        <div class="row">
            <div class="col-md-8">
                <section class="mt-5">
                    <?php if ($PUBLICACION) {
                        $FECHA = explode(" ", $PUBLICACION['fecha']);
                        $FECHA = explode("-", $FECHA[0]);

                        ?>
                        <!-- Grid row -->
                        <div class="row mt-5">
                            <div class="col-md-12 m-3 p-2">
                                <h3><?php echo $PUBLICACION['titulo']; ?></h3>
                            </div>
                            <div class="col-md-12 mb-4">
                                <!-- Card group-->
                                <div class="card-group">

                                    <!-- Card -->
                                    <div class="card mb-md-0 mb-4">

                                        <!-- Card image-->
                                        <div class="overlay">
                                            <img class="card-img-top" src="<?php echo $ruta . 'galeria/usuario/' . rellenarCero($PUBLICACION['idUsuario']) . '/' . $PUBLICACION['imagen']; ?>" alt="Card image cap">
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card card-personal mb-md-0 mb-4">
                                        <!-- Card content -->
                                        <div class="card-body">
                                            <a>
                                                <h4 class="card-title"><?php echo $PUBLICACION['nombreServicio']; ?></h4>
                                            </a>
                                            <a href="<?php echo $ruta . 'perfil/' . rellenarCero($PUBLICACION['idUsuario']); ?>">
                                                <h5 class="card-title"><?php echo $PUBLICACION['nombreU'] . ' ' . $PUBLICACION['apellidos']; ?></h5>
                                            </a>
                                            <a class="card-meta">Publicado: <?php echo $FECHA[2] . ' de  ' . strtolower($mesesAnio[(int) $FECHA[1]]) . ' de ' . $FECHA[0]; ?> </a>
                                            <!-- Text -->
                                            <p class="card-text"><?php echo substr($PUBLICACION['descripcion'], 0, 90) . ((strlen($PUBLICACION['descripcion']) > 90) ? '<a class="text-primary" id="mostrarDescripcion">... más </a>' : ""); ?><span id="descripcionConten" style="display:none;"><?php echo substr($PUBLICACION['descripcion'], 90); ?></span></p>
                                            <a href="#!"><span class="badge <?php echo $SERVICIO['color']; ?> mx-2"><i class="<?php echo $SERVICIO['icono']; ?> pr-2" aria-hidden="true"></i><?php echo $SERVICIO['nombre']; ?></span></a>
                                            <hr>

                                            <a class="card-meta"><span><i class="fas fa-user mr-2"></i><?php echo $NPUB; ?>Publicaciones</span></a>
                                            <p class="card-meta float-right">Miembro desde <?php echo explode('-', (explode(" ", $PUBLICACION['fechaU'])[0]))[0]; ?></p>

                                        </div>
                                        <!-- Card content -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                    <?php } ?>
                    <div class="row p-3">
                        <div class="col-md-12 bg-secondary my-5">
                            <a href="<?php echo $ruta; ?>perfil/00002/Ramon-Vazquez">
                                <img src="<?php echo $ruta; ?>galeria/sistema/banners/4.png" alt="" style="width: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-3 p-2">
                            <h4>Otras publicaciónes recientes</h4>
                        </div>
                        <div class="col">
                            <div class="row" id="cuerpoPublicacionesSP"></div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-12 bg-secondary my-5">
                            <a href="<?php echo $ruta; ?>perfil/00002/Ramon-Vazquez">
                                <img src="<?php echo $ruta; ?>galeria/sistema/banners/4.png" alt="" style="width: 100%;">
                            </a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-md-6 my-5 pt-5">
                <h2 class="">Más publicaciones</h2>
                <div class="row my-5">
                    <div class="col" id="cuerpoRigth">

                    </div>
                </div>
            </div>
        </div>
        <h1>Relación de servicios!</h1>
        <div class="row justify-content-center" id="serviciosBody">

        </div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $("#mostrarDescripcion").on('click', function() {
                $(this).remove();
                $("#descripcionConten").show();
            });
        });
        var idUsuario = <?php echo $PUBLICACION['idUsuario']; ?> + 0;
    </script>
    <script src="<?php echo $ruta; ?>script/postPublico.js"></script>
</body>

</html>