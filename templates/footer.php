<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/js/mdb.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>script/funciones.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>recursos/sweetalert2/sweetalert2.all.min.js"></script>
<?php if ($UserLogin) { ?>
  <script>
    $("#cerrarSesion").on('click', (e) => {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '<?php echo $ruta;?>php/cerrarSesion.php',
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
              setInterval(()=>{ location.reload()},1000);
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