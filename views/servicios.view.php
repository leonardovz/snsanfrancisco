<?php
$acStyles = true;
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
                            <a class="btn btn-outline-white">Leer Más</a>
                        </div>
                        <!--Grid column-->
                        <!--Grid column-->
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
        </div>
        <section class="my-5">

            <!-- Grid row -->
            <div class="row">
                <div class="col-md-12 p-4">
                    <h1></h1>
                    <h3>Ultimas Publicaciones!</h3>
                </div>
                <!-- <h1></h1> -->
                <div class="col-md-12 mb-4">

                    <!-- Card group-->
                    <div class="card-group">

                        <!-- Card -->
                        <div class="card card-personal mb-md-0 mb-4">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/8.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">Anna</h4>
                                </a>
                                <a class="card-meta">Friends</a>
                                <!-- Text -->
                                <p class="card-text">Anna is a web designer living in New York.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>83 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2012</p>

                            </div>
                            <!-- Card content -->

                        </div>
                        <div class="card card-personal mb-md-0 mb-4">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/5.png" alt="Image by Free-Photos from Pixabay">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">John</h4>
                                </a>
                                <a class="card-meta">Coworker</a>
                                <!-- Text -->
                                <p class="card-text">John is a copywriter living in Seattle.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>48 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2015</p>

                            </div>
                            <!-- Card content -->

                        </div>
                        <!-- Card -->

                        <!-- Card -->
                        <div class="card card-personal mb-md-0 mb-4">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/7.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">Sara</h4>
                                </a>
                                <a class="card-meta">Coworker</a>
                                <!-- Text -->
                                <p class="card-text">Sara is a video maker living in Tokyo.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>127 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2014</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col">
                    <a href="<?php echo $ruta; ?>perfil/00002/Ramon-Vazquez">
                        <img src="<?php echo $ruta; ?>galeria/sistema/banners/4.png" alt="" style="width: 100%;">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-4">
                    <h3>Ultimas Publicaciones!</h3>
                </div>
                <div class="col-md-12 mb-4">

                    <!-- Card group-->
                    <div class="card-group">


                        <div class="card card-personal mb-md-0 m-1">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/4.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">Anna</h4>
                                </a>
                                <a class="card-meta">Friends</a>
                                <!-- Text -->
                                <p class="card-text">Anna is a web designer living in New York.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>83 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2012</p>

                            </div>
                            <!-- Card content -->

                        </div>
                        <div class="card card-personal mb-md-0 m-1">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/5.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">John</h4>
                                </a>
                                <a class="card-meta">Coworker</a>
                                <!-- Text -->
                                <p class="card-text">John is a copywriter living in Seattle.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>48 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2015</p>

                            </div>
                            <!-- Card content -->

                        </div>
                        <div class="card card-personal mb-md-0 m-1">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/6.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">Anna</h4>
                                </a>
                                <a class="card-meta">Friends</a>
                                <!-- Text -->
                                <p class="card-text">Anna is a web designer living in New York.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>83 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2012</p>

                            </div>
                            <!-- Card content -->

                        </div>
                        <div class="card card-personal mb-md-0 m-1">

                            <!-- Card image-->
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/7.png" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card image-->

                            <!-- Card content -->
                            <div class="card-body">

                                <!-- Title-->
                                <a>
                                    <h4 class="card-title">Sara</h4>
                                </a>
                                <a class="card-meta">Coworker</a>
                                <!-- Text -->
                                <p class="card-text">Sara is a video maker living in Tokyo.</p>
                                <hr>
                                <a class="card-meta"><span><i class="fas fa-user"></i>127 Friends</span></a>
                                <p class="card-meta float-right">Joined in 2014</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col">
                    <a href="<?php echo $ruta; ?>perfil/00002/Ramon-Vazquez">
                        <img src="<?php echo $ruta; ?>galeria/sistema/banners/4.png" alt="" style="width: 100%;">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-5">
                    <h3>Nuevos Servicios Registrados!</h3>
                </div>
                <div class="col-md-4 mb-4 wow fadeInLeft">
                    <!-- Card -->
                    <div class="card card-image" style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/4.png);">

                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                            <div>
                                <h5 class="pink-text"><i class="far fa-keyboard"></i></i> Desarrollo Web</h5>
                                <h3 class="card-title pt-2"><strong>Crece tus proyectos</strong></h3>
                                <p></p>
                                <a class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
                            </div>
                        </div>

                    </div>
                    <!-- Card -->
                </div>
                <div class="col-md-4 mb-4 wow fadeInDown">
                    <!-- Card -->
                    <div class="card card-image" style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/4.png);">

                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                            <div>
                                <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Diseñador</h5>
                                <h3 class="card-title pt-2"><strong>Mejora tu marca</strong></h3>
                                <p></p>
                                <a class="btn btn-pink"><i class="fas fa-clone left"></i> Ver</a>
                            </div>
                        </div>

                    </div>
                    <!-- Card -->
                </div>
                <div class="col-md-4 mb-4 wow fadeInRight">
                    <!-- Card -->
                    <div class="card card-image " style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/8.png);">

                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                            <div>
                                <h5 class="pink-text"><i class="fab fa-keybase"></i> Estilista</h5>
                                <h3 class="card-title pt-2"><strong>Cambia tu look</strong></h3>
                                <p></p>
                                <a class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
                            </div>
                        </div>

                    </div>
                    <!-- Card -->
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col">
                    <a href="<?php echo $ruta; ?>perfil/00002/Ramon-Vazquez">
                        <img src="<?php echo $ruta; ?>galeria/sistema/banners/4.png" alt="" style="width: 100%;">
                    </a>
                </div>
            </div>
        </section>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script src="<?php echo $ruta; ?>script/servicios.js"></script>
</body>

</html>