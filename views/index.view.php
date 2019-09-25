<?php
$acStyles = true; //deja que se impriman los estios para el formulario

require_once 'templates/header.php';
// $header = new header();
// $header->Metadatados();
?>

<body>
  <!-- Main navigation -->
  <header>
    <!--Navbar-->
    <?php require_once 'templates/header.view.php';?>
    <!-- Navbar -->
    <!-- Full Page Intro -->
    <div class="view" style="background-image: url('<?php echo $ruta; ?>recursos/img/servicios/slide-05.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-indigo-strong d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container">
          <!--Grid row-->
          <div class="row pt-lg-5 mt-lg-5">
            <!--Grid column-->
            <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left wow fadeInLeft" data-wow-delay="0.3s">
              <h1 class="display-4 font-weight-bold"><?php echo $systemName;?></h1>
              <hr class="hr-light">
              <h6 class="mb-3">Subscribete a las noticias y nuevas publicaciónes de nuestros Usuarios. Resuelve todas
                tus inquietudes, envianos tus dudad y sugerencias! estamos para atenderte!

              </h6>
              <a class="btn btn-outline-white">Leer Más</a>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-6 col-xl-5 mb-4">
              <!--Form-->
              <div class="card wow fadeInRight" data-wow-delay="0.3s">
                <div class="card-body z-depth-2">
                  <!--Header-->
                  <div class="text-center">
                    <h3 class="dark-grey-text">
                      <strong>Contactanos:</strong>
                    </h3>
                    <hr>
                  </div>
                  <!--Body-->
                  <div class="md-form">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" id="form3" class="form-control">
                    <label for="form3">Tu nombre</label>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="text" id="form2" class="form-control">
                    <label for="form2">Tu correo</label>
                  </div>
                  <!--Textarea with icon prefix-->
                  <div class="md-form">
                    <i class="fas fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" class="md-textarea form-control" rows="3"></textarea>
                    <label for="form8">Tu mensaje</label>
                  </div>
                  <div class="text-center mt-3">
                    <button class="btn btn-indigo">Enviar</button>
                    <hr>
                    <fieldset class="form-check">
                      <input class="form-check-input" type="checkbox" id="checkbox1">
                      <label class="form-check-label" for="checkbox1" class="dark-grey-text">Subscribirme</label>
                    </fieldset>
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

  <div class="container">
    <!-- Section: Group of personal cards -->
    <section class="my-5">

      <!-- Grid row -->
      <div class="row">
        <div class="col-md-12 pb-2">
          <h2>Nuevos perfiles!</h2>
        </div>
        <div class="col-md-12 mb-4">

          <!-- Card group-->
          <div class="card-group">

            <!-- Card -->
            <div class="card card-personal mb-md-0 mb-4">

              <!-- Card image-->
              <div class="view overlay">
                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/4.png" alt="Card image cap">
                <a href="<?php echo $ruta;?>!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card image-->

              <!-- Card content -->
              <div class="card-body">

                <!-- Title-->
                <a>
                  <h4 class="card-title">Leonardo Vázquez</h4>
                </a>
                <a class="card-meta">Desarrollador Web</a>
                <!-- Text -->
                <p class="card-text">Creación de Sitios Web, da a conocer tu marca de una distinta manera</p>
                <hr>
                <p class="card-meta float-right">Desarrollador web desde 2017</p>

              </div>
              <!-- Card content -->

            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card card-personal mb-md-0 mb-4">

              <!-- Card image-->
              <div class="view overlay">
                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/9.png" alt="Card image cap">
                <a href="<?php echo $ruta;?>!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card image-->

              <!-- Card content -->
              <div class="card-body">

                <!-- Title-->
                <a>
                  <h4 class="card-title">Estetica Kristy</h4>
                </a>
                <a class="card-meta">Estilista</a>
                <!-- Text -->
                <p class="card-text">Cambia tu look, sientete bien.</p>
                <hr>
                <p class="card-meta float-left" style="font-size: 1.75em;">
                  <a target="_blank" href="https://m.me/EsthelaAngulo1.0" class="text-primary"><i class="fab fa-facebook-messenger"></i></a>
                  <a target="_blank" href="https://api.whatsapp.com/send?phone=3313324053" class="text-success mx-5"><i class="fab fa-whatsapp"></i></a>
                </p>

                <p class="card-meta float-right">Agendar una Cita</p>

              </div>
              <!-- Card content -->

            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card card-personal mb-md-0 mb-4">

              <!-- Card image-->
              <div class="view overlay">
                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/6.png" alt="Card image cap">
                <a href="<?php echo $ruta;?>!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card image-->

              <!-- Card content -->
              <div class="card-body">

                <!-- Title-->
                <a>
                  <h4 class="card-title">Vázquez Construcción</h4>
                </a>
                <a class="card-meta">Albañil, Fontanero, electricista</a>
                <!-- Text -->
                <p class="card-text">Hacemos tus ideas y sueños realidad.</p>
                <hr>
                <p class="card-meta float-left" style="font-size: 1.60em;">
                  <a href="tel:3313324053" class="text-success"> <i class="fa fa-phone"></i></a>
                </p>
                <p class="card-meta float-right">Trabajando contigo desde 1985</p>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row p-3">
        <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
      </div>
      <div class="row">
        <h1>Ultimas Publicacione!</h1>
        <div class="col-md-12 mb-4">

          <!-- Card group-->
          <div class="card-group">


            <div class="card card-personal mb-md-0 m-1">

              <!-- Card image-->
              <div class="view overlay">
                <img class="card-img-top" src="<?php echo $ruta; ?>recursos/img/usuario/4.png" alt="Card image cap">
                <a href="<?php echo $ruta;?>!">
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
                <a href="<?php echo $ruta;?>!">
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
                <a href="<?php echo $ruta;?>!">
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
                <a href="<?php echo $ruta;?>!">
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
      <div class="row p-3">
        <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
      </div>
      <h1>Nuevos Servicios Registrados!</h1>
      <div class="row">
        <div class="col-md-4 mb-4 rubberBand">
          <!-- Card -->
          <div class="card card-image" style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/4.png);">

            <!-- Content -->
            <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
              <div>
                <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Desarrollo Web</h5>
                <h3 class="card-title pt-2"><strong>Crece tus proyectos</strong></h3>
                <p></p>
                <a class="btn btn-pink"><i class="fas fa-clone left"></i> Ver más</a>
              </div>
            </div>

          </div>
          <!-- Card -->
        </div>
        <div class="col-md-4 mb-4">
          <!-- Card -->
          <div class="card card-image" style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/8.png);">

            <!-- Content -->
            <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
              <div>
                <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Diseñador</h5>
                <h3 class="card-title pt-2"><strong>Mejora tu marca</strong></h3>
                <p></p>
                <a class="btn btn-pink"><i class="fas fa-clone left"></i> Ver más</a>
              </div>
            </div>

          </div>
          <!-- Card -->
        </div>
        <div class="col-md-4 mb-4">
          <!-- Card -->
          <div class="card card-image" style="background-image: url(<?php echo $ruta; ?>recursos/img/usuario/4.png);">

            <!-- Content -->
            <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
              <div>
                <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Estilistas</h5>
                <h3 class="card-title pt-2"><strong>Cambia tu look</strong></h3>
                <p></p>
                <a class="btn btn-pink"><i class="fas fa-clone left"></i> Ver más</a>
              </div>
            </div>

          </div>
          <!-- Card -->
        </div>
      </div>
      <div class="row p-3">
        <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
      </div>
    </section>

  </div>
  
  <?php require_once 'templates/footer.view.php'; ?>
  <?php require_once 'templates/footer.php'; ?>

  <script src="<?php echo $ruta;?>script/index.js"></script>

  
</body>

</html>