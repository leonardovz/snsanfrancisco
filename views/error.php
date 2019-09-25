<?php
$acStyles = true;
require_once 'templates/header.php';
// $header = new header();
// $header->Metadatados();
?>

<body>
  <header>
    <?php require_once 'templates/header.view.php'; ?>

    <div class="view" style="background-image: url('<?php echo $ruta; ?>recursos/img/servicios/slide-05.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-indigo-strong d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container">
          <!--Grid row-->
          <div class="row pt-lg-5 mt-lg-5">
            <!--Grid column-->
            <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left wow fadeInLeft" data-wow-delay="0.3s">
              <h1 class="display-4 font-weight-bold">¡Hola amig@! ¿Te encuentras extraviado?</h1>
              <h2 class="display-4 font-weight-bold text-danger">Error <?php echo (isset($rutas[1]) && !empty($rutas[1]) ? (int) $rutas[1] : ""); ?></h2>
              <hr class="hr-light">
              <h6 class="mb-3">
                Ayudanos a corregir este error
                Completa el siguiente formulario para poder seguir mejorando este servicio que es pata ti
              </h6>
              <?php
              if ($rutas[1] == 404) {
                echo '<h3>¿Que es un Error 404?</h3>';
                echo '<p> HTTP 404 Not Found o HTTP 404 No encontrado es un código de estado HTTP que indica que el host ha sido capaz de comunicarse con el servidor, pero no existe el recurso que ha sido pedido.</p>
                <p>En sintesis, te comunico que el enlace al que quieres ingresar no es corecto o no existe</p>';
              }
              ?>
              <!-- <a class="btn btn-outline-white">Leer Más</a> -->
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
                    <label for="form3">Tu nombre (Opcional)</label>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="text" id="form2" class="form-control">
                    <label for="form2">Tu correo (Opcional)</label>
                  </div>
                  <!--Textarea with icon prefix-->
                  <div class="md-form">
                    <i class="fas fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" class="md-textarea form-control" rows="3"></textarea>
                    <label for="form8">Cuentanos ¿Comó llegaste hasta aquí?</label>
                  </div>
                  <div class="text-center mt-3">
                    <button class="btn btn-indigo">Enviar</button>
                    <hr>
                    <fieldset class="form-check">
                      <!-- <input class="for
                      m-check-input" type="checkbox" id="checkbox1"> -->
                      <!-- <label class="form-check-label" for="checkbox1" class="dark-grey-text">Subscribirme</label> -->
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
  </header>
  <?php require_once 'templates/footer.view.php'; ?>
  <?php require_once 'templates/footer.php'; ?>
</body>

</html>