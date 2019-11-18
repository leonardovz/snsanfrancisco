<?php
$CROOPER = true;
$FUNCIONES = new AdminFunciones();
$FUNCIONES->CONEXION = $conexion;

$systemName =  'Consulta y Ayuda | ' . $systemName;

require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!--Modal: mdb-abandonedCart-hard-->
                <div class="modal-dialog modal-notify modal-warning" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <p class="heading">¿Estas teniendo problemas?</p>
                        </div>

                        <!--Body-->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-3 text-center">
                                    <img src="<?php echo $ruta; ?>galeria/sistema/logo/5.png" alt="Michal Szymanski - founder of Material Design for Bootstrap" class="img-fluid z-depth-1-half rounded-circle">
                                    <div style="height: 10px"></div>
                                    <p class="title mb-0">SnSanFrancisco</p>
                                    <p class="text-muted " style="font-size: 13px">Atención</p>
                                </div>

                                <div class="col-9">
                                    <p>Si tienes algun problema contesta el formulario y daremos contestación lo antes posible</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 my-4">
                <div class="card-body z-depth-2">
                    <!--Header-->
                    <div class="text-center">
                        <h3 class="dark-grey-text">
                            <strong>Contactanos:</strong>
                        </h3>
                        <hr>
                    </div>
                    <label>¿Cuál es tu problema?</label>
                    <select id="problemaTipo" class="browser-default custom-select mb-4">
                        <option value="Perfil">No carga mi perfil público</option>
                        <option value="Publicación" selected>No pueden ver mis publicaciones</option>
                        <option value="Servicio">Necesito que registren mi servicio</option>
                        <option value="Explicito">Publicaciones inapropiadas</option>
                        <option value="otras">Otro problema</option>
                    </select>
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
                            <label class="custom-control-label" for="subscripcionCon">Recibir contestación</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        var ruta = ruta();
        $("#btnContacto").on('click', function() {
            var nombre = $("#nombreCon"),
                correo = $("#correoCon"),
                mensaje = $("#mensajeCon"),
                tipo = $("#problemaTipo"),
                sub = $("#subscripcionCon");

            if (sub.is(':checked')) {
                sub = 1;
            } else {
                sub = 0;
            }
            if ((mensaje.val() == "" && tipo.val() == "") || mensaje.val().length < 10) {
                alertaSwal('Debes de seleccionar un problema y describir tu mensaje','error');
            } else {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Estas apunto de enviar un mensaje de contacto!",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si seguro!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: ruta + 'php/publico.php',
                            dataType: "json",
                            data: `opcion=enviarCorreoContacto&nombre=${nombre.val()}&correo=${correo.val()}&descripcion=${mensaje.val()}&subscripcion=${sub}&tipo=${tipo.val()}`,
                            error: function(xhr, resp) {
                                console.log(xhr.responseText);
                            },
                            success: function(data) {
                                nombre.val("");
                                correo.val("");
                                mensaje.val("");
                                alertaSwal(data.Texto, 'success');
                            }
                        });
                    }
                });
            }


        });
    </script>
</body>

</html>