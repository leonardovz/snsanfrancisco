<?php require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br><br><br>
    </header>
    <div class="container">
        <div class="row my-5">

            <div class="col-lg-5">
                <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                    <img class="img-fluid" src="<?php echo $ruta; ?>galeria/userMaster/master_01.png" alt="Sample image">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 mt-5 pt-5">
                <!-- Category -->
                <a href="#!" class="indigo-text">
                    <h6 class="font-weight-bold mb-3"><i class="fas fa-code pr-2"></i>INGENIERO EN COMPUTACION</h6>
                </a>
                <h3 class="font-weight-bold mb-3"><strong>Leonardo Vázquez Angulo</strong></h3>
                <h6 class="font-weight-bold mb-3"><i class="fas fa-code pr-2"></i>Desarrollador Web</h6>
                <!-- Post title -->
                <!-- Excerpt -->
                <p>Trabajando por ofrecer mejor calidad de trabajo y hacer crecer a nuestra comunidad en el hambiente tecnologico</p>
                <!-- Post data -->
                <p>Desarrollador <a><strong>Junior</strong></a>, 11/08/2017</p>
                <!-- Read more button -->
                <!-- <a class="btn btn-indigo btn-md">Read more</a> -->

            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <!-- <h2>Ing. Leonardo Vázquez Angulo</h2>
                <h3>San Francisco de Asís</h3> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Section heading -->
                <h2 class="h1-responsive font-weight-bold my-5">Portafolio</h2>
                <!-- Section description -->
                <p class="grey-text w-responsive mx-auto">Aquí se encuentran algunos de mis proyectos desarrollados, algunos de ellos fueron en colaboración de amigos. </p>
                <p class="grey-text w-responsive mx-auto mb-5">Gracias a la experiencia obtenida en cada uno de estos proyectos, he podido crecer exponencialmente en mis conocimientos sobre esto que son las tecnologías y el desarrollo web</p>

                <!-- Grid row -->
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-4 col-md-12  my-5">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="<?php echo $ruta; ?>galeria/userMaster/snsanfrancisco.png" class="img-fluid" alt="Sample project image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!--Excerpt-->
                        <div class="card-body pb-0">
                            <h4 class="font-weight-bold my-3">snsanfrancisco</h4>
                            <p class="grey-text">Plataforma de servicios, y publicidad digital
                            </p>
                            <a href="https://snsanfrancisco.com"  target="_blank" class="btn btn-indigo btn-sm"><i class="fas fa-clone left"></i> Ver Proyecto</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6  my-5">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="<?php echo $ruta; ?>galeria/userMaster/hello.png" class="img-fluid" alt="Sample project image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!--Excerpt-->
                        <div class="card-body pb-0">
                            <h4 class="font-weight-bold my-3">Hello Market</h4>
                            <p class="grey-text">Sistema para el control de una tienda virtual de Supermercado, <i class="text-dark">proyecto en colaboración</i>
                            </p>
                            <a href="https://hellomarket.com.mx"  target="_blank" class="btn btn-indigo btn-sm"><i class="fas fa-clone left"></i> Ver proyecto</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-5">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="<?php echo $ruta; ?>galeria/userMaster/lacteos.png" class="img-fluid" alt="Sample project image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!--Excerpt-->
                        <div class="card-body pb-0">
                            <h4 class="font-weight-bold my-3">Lacteos Alteños</h4>
                            <p class="grey-text">Sistema para el control de inventario y produccion de la empresa <b><i>Lacteos Alteños</i></b> <i class="text-dark">proyecto en colaboración</i></p>
                            <a href="https://lacteosaltenos.com"  target="_blank" class="btn btn-indigo btn-sm"><i class="fas fa-clone left"></i> Ver proyecto</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-5">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="<?php echo $ruta; ?>galeria/userMaster/indice.png" class="img-fluid" alt="Sample project image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!--Excerpt-->
                        <div class="card-body pb-0">
                            <h4 class="font-weight-bold my-3">INDICE</h4>
                            <p class="grey-text">Proyecto realizado para el Gobierno de Tepatitlán, me aporto gran crecimiento como desarrollador<i class="text-dark">proyecto en colaboración</i>
                            </p>
                            <a href="https://indice.tepatitlan.gob.mx" target="_blank" class="btn btn-indigo btn-sm"><i class="fas fa-clone left"></i> Ver proyecto</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-5 ">
                        <!--Featured image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="<?php echo $ruta; ?>galeria/userMaster/tepaemprende.png" class="img-fluid" alt="Sample project image">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!--Excerpt-->
                        <div class="card-body pb-0">
                            <h4 class="font-weight-bold my-3">Tepa Emprende</h4>
                            <p class="grey-text">Proyecto realizado para el Gobierno de Tepatitlán, apoyo para los jovenes emprendedores<i class="text-dark">proyecto en colaboración</i>
                            </p>
                            <a href="https://tepaemprende.com"  target="_blank" class="btn btn-indigo btn-sm mt-4"><i class="fas fa-clone left"></i> Ver proyecto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'templates/footer.php'; ?>
    <?php require_once 'templates/footer.view.php'; ?>
</body>

</html>