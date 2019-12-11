<?php
$CROOPER = true;
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
$PERFIL = $FUNCIONES->verificarPerfil($idUsuario); //configuraci[on del perfil]
$SERVICIO = false;
$PAQUETE = false;
if ($PERFIL) {
    $PERFIL = $PERFIL->fetch_assoc();
    $SERVICIO = $FUNCIONES->verificarServicio($PERFIL['idServicio']);
    if ($SERVICIO) {
        $SERVICIO = $SERVICIO->fetch_assoc();
    }
    $PAQUETE = $FUNCIONES->paquetePerfilUser($PERFIL['iduser']);
}
if ($PERFIL) {
    $systemName = $PERFIL['nombreServicio'] . ' | ' . $systemName;
    $keyWords = $SERVICIO['nombre'] . ' | ' . $keyWords;
    $descripcionServ = $descripcionServ . ' - ' . $PERFIL['nombre'] . ' ' . $PERFIL['apellidos'] . ' te ofrece su servicio de ' . $SERVICIO['nombre'];
}
require_once 'templates/header.php'; ?>


<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>

    <?php
    if (!$PERFIL) { ?>
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
                                        <img src="<?php echo $ruta; ?>galeria/sistema/logo/5.png" alt="Michal Szymanski - founder of Material Design for Bootstrap" class="img-fluid z-depth-1-half rounded-circle">
                                        <div style="height: 10px"></div>
                                        <p class="title mb-0">SnSanFrancisco</p>
                                        <p class="text-muted " style="font-size: 13px">Consultame</p>
                                    </div>

                                    <div class="col-9">
                                        <p>Intentaste ingresar a un perfil que no existe, es muy provable que la cuenta se haya dado de baja, o el perfil este bloqueado.</p>
                                        <p class="card-text"><br>
                                            <strong>¿No encuentras tu perfil?</strong>
                                        </p>
                                    </div>
                                </div>


                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center flex-wrap">
                                <a href="<?php echo $ruta; ?>ayuda" type="button" class="btn btn-warning waves-effect waves-light">Necesito Ayuda</a>
                                <a href="<?php echo $ruta; ?>" type="button" class="btn btn-outline-warning waves-effect">Quiero volver al Inicio</a>
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
    <div class="container">
        <div class="row justify-content-end">
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="magazine-section mt-2 mb-5">
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="single-news mb-lg-0 mb-">
                                <div class="view overlay rounded-circle z-depth-1-half mb-4">
                                    <img src="<?php echo fotoPerfilPublico($PERFIL['img'], $PERFIL['iduser'], $ruta); ?>" alt="Image Profile" style="width: 100%;">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                            </div>
                            <!-- Featured news -->

                        </div>
                        <div class="col-md-6">

                            <!-- Featured news -->
                            <div class="single-news mb-lg-0 mb-5 pt-5 text-justify">
                                <div class="news-data d-flex justify-content">
                                    <a href="#!" class="deep-blue-text">
                                        <h6 class="font-weight-bold"><i class="<?php echo $SERVICIO['icono'] ?> pr-2"></i><?php echo $SERVICIO['nombre']; ?></h6>
                                    </a>
                                </div>
                                <h2 class="font-weight-bold dark-grey-text mb-3"><a><?php echo $PERFIL['nombre'] . ' ' . $PERFIL['apellidos'] ?></a></h2>
                                <h3 class="font-weight-bold dark-grey-text mb-3"><a><?php echo $PERFIL['nombreServicio'] ?></a></h3>
                                <p class="dark-grey-text mb-lg-0 mb-md-5 mb-4"><?php echo substr($PERFIL['descripcion'], 0, 300) . ((strlen($PERFIL['descripcion']) > 300) ? '<a class="text-primary" id="mostrarDescripcion">... más </a>' : ""); ?>
                                    <span id="descripcionConten" style="display:none;"><?php echo substr($PERFIL['descripcion'], 300); ?></span></p>
                                </p>

                            </div>
                            <!-- Featured news -->

                        </div>

                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12">
                                    <?php if (isset($ADSENSE) && $ADSENSE) { ?>
                                        <script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row" id="cuerpoPublicaciones">
                                <div class="col">
                                    <p>Cargando ... </p>
                                    <div class="progress">
                                        <div id="progressPub" class="progress-bar progress-bar-striped progress-bar-animated unique-color" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" style="width: 3%">
                                            3%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <a class="btn btn-info" id="verMasPosts" style="display:none;"> Ver más</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-0">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="card-body contact text-center h-100 bg-primary white-text rounded z-depth-1">

                                        <h3 class="my-4 pb-2">Información de contacto</h3>
                                        <ul class="text-lg-left list-unstyled ml-4">
                                            <li id="codigoPostal" data-postal="<?php echo $PERFIL['CP']; ?>"> </li>
                                            <li>
                                                <p><i class="fas fa-map-marker-alt pr-2"></i><?php echo $PERFIL['colonia']; ?></p>
                                            </li>
                                            <li>
                                                <p><i class="fas fa-map-marker-alt pr-2"></i><?php echo $PERFIL['domicilio']; ?></p>
                                            </li>

                                            <li>
                                                <p><i class="fas fa-phone pr-2"></i><a class="text-white h6" href="tel:<?php echo $PERFIL['telefono']; ?>"><?php echo $PERFIL['telefono']; ?></a></p>
                                            </li>
                                            <li>
                                                <p><i class="fas fa-envelope pr-2"></i><a class="text-white h6" href="mailto:<?php echo $PERFIL['correoServicio']; ?>"><?php echo $PERFIL['correoServicio']; ?></a> </p>
                                            </li>
                                        </ul>
                                        <hr class="hr-light my-4">
                                        <?php
                                        if ($PAQUETE && $PAQUETE['membresia']['rol'] != 'Gratis' && $PAQUETE['status']) { ?>
                                            <h3 class="my-4 pb-2">Redes Sociales</h3>

                                            <ul class="list-inline text-center list-unstyled" id="socialContact">

                                            </ul>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <h2 class="">Más publicaciones</h2>
                            <div class="row my-5">
                                <div class="col" id="cuerpoRigth">

                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col">
                                    <?php if (isset($ADSENSE) && $ADSENSE) { ?>
                                        <script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col">
                                    <?php if (isset($ADSENSE) && $ADSENSE) { ?>
                                        <script data-ad-client="ca-pub-3411329531589521" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center" id="contServicios"></div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>

    <script>
        $(document).ready(function() {
            new WOW().init();
            $(".wow").on('click', (e) => {
                e.preventDefault();
            });
            $("#mostrarDescripcion").on('click', function() {
                $(this).remove();
                $("#descripcionConten").show();
            });
            var $codigoPostal = $("#codigoPostal");
            $.ajax({
                type: "POST",
                url: '<?php echo $ruta; ?>/php/publico.php',
                dataType: "json",
                data: "opcion=codigoPostal&CP=" + $codigoPostal.attr('data-postal'),
                error: function(xhr, resp) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    console.log(data);
                    if (data.respuesta == "exito") {
                        data = data.codigos[0];
                        $codigoPostal.html(` <p><i class="fas fa-phone pr-2"></i>${data.municipio}</p>`);
                    } else {

                    }
                }
            });
        });
        var perfilAC = <?php echo $idUsuario; ?> + 0;
        <?php

        if ($PAQUETE && $PAQUETE['membresia']['rol'] != 'Gratis' && $PAQUETE['status']) {
            echo 'var social = ' . $PERFIL['social'] . ';';
            echo '';

            ?>
            var cuerpoSocial = "";
            if (social.facebook && social.facebook != '') {
                cuerpoSocial += `<li class="list-inline-item"> <a target="_blank" href="https://www.facebook.com/${(social.facebook)}"class="p-2 fa-lg tw-ic text-white"><i class="fab fa-facebook-f"></"></i></a> </li>`;
            }
            if (social.whatsapp && social.whatsapp != '') {
                cuerpoSocial += `<li class="list-inline-item"> <a target="_blank" href="https://api.whatsapp.com/send?phone=52${(social.whatsapp)}"class="p-2 fa-lg tw-ic text-white"><i class="fab fa-whatsapp"></i></a> </li>`;
            }
            if (social.messenger && social.messenger != '') {
                cuerpoSocial += `<li class="list-inline-item"> <a target="_blank" href="https://www.messenger.com/t/${(social.messenger)}"class="p-2 fa-lg tw-ic text-white"><i class="fab fa-facebook-messenger"></i></a> </li>`;
            }
            if (social.personalWeb && social.personalWeb != '') {
                cuerpoSocial += `<li class="list-inline-item"> <a target="_blank" href="https://${(social.personalWeb)}"class="p-2 fa-lg tw-ic text-white"><i class="fas fa-laptop-code"></i></a> </li>`;
            }
            $("#socialContact").html(cuerpoSocial);
        <?php  } ?>
    </script>
    <script src="<?php echo $ruta; ?>script/publicPerfil.js "></script>
</body>

</html>