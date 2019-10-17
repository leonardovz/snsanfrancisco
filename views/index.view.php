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
    <?php require_once 'templates/header.view.php'; ?>
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
              <h1 class="display-4 font-weight-bold"><?php echo $systemName; ?></h1>
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
                    <input type="text" id="nombreCon" class="form-control">
                    <label for="nombreCon">Tu nombre</label>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="text" id="correoCon" class="form-control">
                    <label for="correoCon">Tu correo</label>
                  </div>
                  <!--Textarea with icon prefix-->
                  <div class="md-form">
                    <i class="fas fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="mensajeCon" class="md-textarea form-control" rows="3"></textarea>
                    <label for="mensajeCon">Tu mensaje</label>
                  </div>
                  <div class="text-center mt-3">
                    <button class="btn btn-indigo" id="btnContacto">Enviar</button>
                    <hr>
                    <div class="custom-control custom-checkbox mb-4">
                      <input type="checkbox" class="custom-control-input" id="subscripcionCon">
                      <label class="custom-control-label" for="subscripcionCon">Subscribirme</label>
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

  <div class="container">
    <!-- Section: Group of personal cards -->
    <section class="my-5">

      <!-- Grid row -->
      <div class="row">
        <div class="col-md-12 pb-2">
          <h2>Nuevos perfiles!</h2>
        </div>
        <div class="col-md-12 mb-4">
          <div class="row" id="cuerpoPerfiles">
          </div>
        </div>
      </div>
      <div class="row p-3">
        <div class="col-md-12 bg-secondary"><br><br><br><br><br><br></div>
      </div>
      <div class="row">
        <h1>Ultimas Publicacione!</h1>
        <div class="col-md-12 mb-4">
          <div class="row" id="cuerpoPublicaciones">
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

  <script src="<?php echo $ruta; ?>script/index.js"></script>


</body>

</html>