<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/mdb.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/sweetalert2/sweetalert2.min.js"></script>

<?php if (isset($summernote) && $summernote) { ?>
  <script type="text/javascript" src="<?php echo $ruta; ?>recursos/summernote/summernote-lite.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo $ruta; ?>script/funciones.js"></script>

<?php if ($UserLogin) { ?>
  <script>
    $("#cerrarSesion").on('click', (e) => {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '<?php echo $ruta; ?>php/cerrarSesion.php',
        data: 'opcion=cerrarSesion',
        dataType: 'json',
        error: function(xhr, status) {
          console.log(JSON.stringify(xhr));
        },
        success: function(data) {
          console.log(data);
          if (data.respuesta == 'exito') {
            Swal.fire(
              'Exito!',
              data.Texto,
              'success'
            );
            setInterval(() => {
              location.reload()
            }, 1000);
            // location.reload();
          } else {
            Swal.fire(
              'Alerta!',
              data.Texto,
              'error'
            );
          }
        }
      });
    });
  </script>
<?php } ?>
<script>
  $("#formSubscripcion").on('submit', function(e) {
    e.preventDefault();
    let formulario = $(this).serialize();
    $.ajax({
      type: "POST",
      url: ruta + 'php/usuariosAJAX.php',
      dataType: "json",
      data: 'opcion=subscribirCuenta&' + formulario,
      error: function(xhr, resp) {
        console.log(xhr.responseText);
      },
      success: function(data) {
        if (data.respuesta == "exito") {
          Swal.fire({
            icon: 'success',
            text: data.Texto,
          });
        } else {
          Swal.fire({
            icon: 'error',
            text: data.Texto,
          });
        }
      }
    });
  });
</script>

<script>
  var terminos = localStorage.getItem('terminos_y_condiciones_snsanfrancisco')
  if (!terminos) {
    $("#sideModalTR").modal('show');
    setTimeout(() => {
      localStorage.setItem('terminos_y_condiciones_snsanfrancisco', 1);
    }, 10000);
  }
</script>