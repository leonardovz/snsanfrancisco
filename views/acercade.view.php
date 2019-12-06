<?php require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br><br><br>
    </header>
    <div class="container">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-4">

                    <img src="<?php echo $ruta; ?>galeria/sistema/images/SnSanFranciscoCF.png" class="img-fluid z-depth-1-half" alt="">

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-4 text-justify">

                    <!-- Main heading -->
                    <h3 class="h3 mb-3"><?php echo $systemName ?> </h3>
                    <p>Aquí te mostramos una de las ventajas de formar parte
                        <strong>SnSanfrancisco</strong> .</p>
                    <p>Permite a las personas saber que tu ofreces un buen servicio.</p>
                    <!-- Main heading -->

                    <hr>

                    <p>
                        <strong>80%+</strong> de las personas que necesitan agún servicio, primero lo buscan en su internet,
                        el otro <strong>20%</strong> consultan la recomendación de un familiar sobre negocios o servicios <br>
                        ¡Deja que ese <strong>80%</strong> te encuentre de una manera más sencilla!

                    </p>

                    <!-- CTA -->
                    <a href="<?php echo $ruta; ?>registro" class="btn btn-indigo btn-md">Registrarme
                        <i class="fas fa-users-cog mx-3"></i>
                    </a>
                    <a href="<?php echo $ruta; ?>login" class="btn btn-indigo btn-md">Iniciar Sesión
                        <i class="fas fa-sign-in-alt mx-3"></i>
                    </a>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Main info-->

        <hr class="my-5">

        <!--Section: Main features & Quick Start-->
        <section>

            <h2 class="h3 text-center mb-5">San Francisco de Asís Jalisco <a target="_BLANK" href="https://goo.gl/maps/Eeq2Yzbcaog7sxU8A"><i class="fas fa-map-marker text-info mx-3"></i> <sub class="text-success"></sub></a> </h2>

            <!--Grid row-->
            <div class="row justify-content-center wow fadeIn text-center">

                <div class="col-lg-6 col-md-6 px-4 my-4">
                    <div class="card card-cascade">
                        <div class="card-body card-body-cascade text-center">
                            <h4 class="card-title"><strong> <i class="fas fa-chart-line fa-2x indigo-text"></i></strong></h4>
                            <h6 class="font-weight-bold indigo-text py-2">CRECIMIENTO</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 px-4 my-4">
                    <div class="card card-cascade">
                        <div class="card-body card-body-cascade text-center">
                            <h4 class="card-title"><strong> <i class="fas fa-people-carry fa-2x indigo-text"></i></strong></h4>
                            <h6 class="font-weight-bold indigo-text py-2">SERVICIOS</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 px-4 my-4">
                    <div class="card card-cascade">
                        <div class="card-body card-body-cascade text-center">
                            <h4 class="card-title"><strong> <i class="fas fa-users-cog fa-2x indigo-text"></i></strong></h4>
                            <h6 class="font-weight-bold indigo-text py-2">HABILIDADES</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 px-4 my-4">
                    <div class="card card-cascade">
                        <div class="card-body card-body-cascade text-center">
                            <h4 class="card-title"><strong> <i class="fas fa-brain fa-2x indigo-text"></i></strong></h4>
                            <h6 class="font-weight-bold indigo-text py-2">CONOCIMIENTO</h6>
                        </div>
                    </div>
                </div>
        </section>
        <!--Section: Main features & Quick Start-->

        <hr class="my-5">

        <!--Section: Not enough-->

        <h2 class="my-5 h3 text-center">¿Qué ofrece SnSanFrancisco?</h2>
        <div class="row features-small mb-5 mt-3 wow fadeIn">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Contacto directo con Whatsapp</h6>
                        <p class="grey-text">Conecta directamente tu negocio con las personas que lo necesitan</p>
                        <div style="height:15px"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Deja que las personas te encuentren</h6>
                        <p class="grey-text">Tu negocio a el alcance de un click</p>
                        <div style="height:15px"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Telefono y botón de llamada directa</h6>
                        <p class="grey-text">¿Por qué hacerlos esperar?</p>
                        <div style="height:15px"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Muestrales tu portafolio de trabajo</h6>
                        <p class="grey-text">¡Una imagen dice más que mil palabras!. ¡Muestrales lo que haces!</p>
                        <div style="height:15px"></div>
                    </div>
                </div>
                <!--/Fourth row-->
            </div>
            <div class="col-md-4 flex-center">
                <img src="https://mdbootstrap.com/img/Others/screens.png" alt="MDB Magazine Template displayed on iPhone" class="z-depth-0 img-fluid">
            </div>
            <div class="col-md-4 mt-2">
                <!--First row-->
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Dirección para que puedan contactarte de manera más directa</h6>
                        <p class="grey-text">Si las visitas te ayudan a generar ventas... ¡Diles a las personas donde te encuentras!
                        </p>
                        <div style="height:15px"></div>
                    </div>
                </div>
                <!--/First row-->

                <!--Second row-->
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-check-circle fa-2x indigo-text"></i>
                    </div>
                    <div class="col-10">
                        <h6 class="feature-title">Acceso desde cualquier Dispositivo</h6>
                        <p class="grey-text">Desde cualquier dispositivo a cualquier hora y cualquier minuto podrán acceder a tu información y contactarte de manera inmediata</p>
                        <div style="height:15px"></div>
                    </div>
                </div>
            </div>
            <hr class="mb-5">
        </div>
    </div>
    <div class="container-fluid">

        <h2 class="my-5 h3 text-center">¿Quieres ser colaborador?</h2>
        <h4 class="my-5 h5 text-center">¿Qúe necesito para ser colaborador / patrocinador?,¿Qué beneficios obtengo?</h4>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                <div class="card mb-4">
                    <div class="card-header text-center primary-color-dark">
                        <h4 class="h6 text-white">Trimestral</h4>
                    </div>
                    <div class="card-body text-center primary-color text-white">
                        <h4 class="card-title"><sup>$</sup><span style="font-size: 2.5em;">660</span>.00/mxn</h4>
                    </div>
                    <div class="card-footer bg-white">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-barcode mr-2"></i> Código de activación de 1 mes</li>
                            <li class="list-group-item"><i class="fas fa-code-branch mr-2"></i>15 publicaciones</li>
                            <li class="list-group-item"><i class="fab fa-fedora mr-2"></i> Enlace a redes sociales</li>
                            <li class="list-group-item"><i class="far fa-address-card mr-2"></i>Creación y configuración de perfil</li>
                            <li class="list-group-item text-danger"><strike><i class="fas fa-ad mr-2"></i>Creación de publicaciones</strike> </li>
                            <li class="list-group-item"><i class="fas fa-user-tie mr-2"></i>Aparece en la sección de patrocinadores</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                <div class="card mb-4">
                    <div class="card-header text-center secondary-color-dark">
                        <h4 class="h6 text-white">Semestral</h4>
                    </div>
                    <div class="card-body text-center secondary-color text-white">
                        <h4 class="card-title"><sup>$</sup><span style="font-size: 2.5em;">1200</span>.00/mxn</h4>
                    </div>
                    <div class="card-footer bg-white">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-barcode mr-2"></i> Código de activación de 6 meses</li>
                            <li class="list-group-item"><i class="fas fa-code-branch mr-2"></i>22 publicaciones</li>
                            <li class="list-group-item"><i class="fab fa-fedora mr-2"></i> Enlace a redes sociales</li>
                            <li class="list-group-item"><i class="far fa-address-card mr-2"></i>Creación y configuración de perfil</li>
                            <li class="list-group-item"><i class="fas fa-ad mr-2"></i>Creación de 2 publicaciones</li>
                            <li class="list-group-item"><i class="fas fa-user-tie mr-2"></i>Aparece en la sección de patrocinadores</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                <div class="card mb-4">
                    <div class="card-header text-center unique-color-dark">
                        <h4 class="h6 text-white">Anual</h4>
                    </div>
                    <div class="card-body text-center unique-color text-white">
                        <h4 class="card-title"><sup>$</sup><span style="font-size: 2.5em;">2400</span>.00/mxn</h4>
                    </div>
                    <div class="card-footer bg-white">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-barcode mr-2"></i> Código de activación de 12 meses</li>
                            <li class="list-group-item"><i class="fas fa-code-branch mr-2"></i>35 publicaciones</li>
                            <li class="list-group-item"><i class="fab fa-fedora mr-2"></i> Enlace a redes sociales</li>
                            <li class="list-group-item"><i class="far fa-address-card mr-2"></i>Creación y configuración de perfil</li>
                            <li class="list-group-item"><i class="fas fa-ad mr-2"></i>Creación de 5 publicaciones</li>
                            <li class="list-group-item"><i class="fas fa-user-tie mr-2"></i>Aparece en la sección de patrocinadores</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--/Second row-->

    </div>
    <div class="container-fluid unique-color text-white">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center pt-5">
                    <div class="col-12 text-center">
                        <h2>¿Qué son las membresías SnSanFrancisco?</h2>
                    </div>
                    <div class="col-md-10 col-sm-12 text-justify py-5" style="font-size: 1.1em;">
                        <img src="<?php echo $ruta; ?>galeria/sistema/images/SnSanFranciscoCF.png" style=" width: 385px; float: right; padding-left: 10px;">
                        <p> <b class="h5">SnSanFrancisco</b> ha logrado desarrollarse durante este año, esto solo con los ingresos que se obtienen mediante otros servicios. Nuestro objetivo es crear un proyecto dedicado <b class="h5">principalmente para ustedes</b>, nuestros <b class="h5">usuarios, familiares y amigos</b>, emprendedores de San Francisco de Asís, y los ingresos que de alguna manera de han obtenido se han invertido en su totalidad para seguir con el desarrollo de este gran proyecto; invertimos en pagos de servicios de terceros para mantenernos en línea (servidores y dominio) y remuneraciones económicas para nuestros colaboradores. En otras palabras, estos ingresos no han sido los suficientes para lograr cambios considerables dentro de nuestra plataforma. Por esta razón nos vimos con la necesidad de buscar otras soluciones.</p>
                        <p>Las membresías de <b class="h5">SnSanFrancisco</b> abren la posibilidad de que ustedes puedan invertir un poco de su dinero para impulsar este proyecto, y al mismo tiempo obtener algunos beneficios dentro de nuestro sitio.</p>
                        <p>Los ingresos obtenidos mediante las membresías y patrocinios serán utilizados para encontrar un modelo viable a largo plazo que nos permita mejorar constantemente la calidad del contenido que publicamos, así como llegar a un público más amplio en los servicios que ofrecemos. Para lograr esto se invertirá en infraestructura, aumentar nuestra plantilla editorial, y, sobre todo, mejorar las condiciones de trabajo para nuestros colaboradores.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'templates/footer.php'; ?>
    <?php require_once 'templates/footer.view.php'; ?>
</body>

</html>