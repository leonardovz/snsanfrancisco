<?php 
$systemName = "Paquetes & Planes | " . $systemName;
require_once 'templates/header.php'; ?>

<body>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>
        <br><br>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Compra el paquete a tu medida</h2>
                <p>Para obtener esta alguna de estas cuentas ten en cuenta las necesidades o hasta donde quieres llegar</p>
            </div>
        </div>
        <div class="row justify-content-center"  id="paqueteBasico">

            <div class="col-md-4">
                <div class="col-md-12 mb-lg-0 mb-4">

                    <!-- Card -->
                    <div class="card">

                        <!-- Content -->
                        <div class="card-body">

                            <!-- Offer -->
                            <h5 class="mb-4 text-center">Plan Premium</h5>
                            <div class="d-flex justify-content-center">
                                <div class="card-circle d-flex justify-content-center align-items-center">
                                    <i class="fas fa-home indigo-text" style="font-size: 2em;"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bold my-4 text-center">59$</h2>
                            <p class="grey-text"><i class="fas fa-star"></i> Registro de Servicio</p>
                            <p class="grey-text"><i class="fas fa-star"></i> Unica publicación</p>
                            <p class="grey-text"><i class="fas fa-star"></i> Registro de Servicio</p>
                            <a class="btn btn-indigo btn-rounded btn-block">Registrarme</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Compra el paquete a tu medida</h2>
                <p>Para obtener esta alguna de estas cuentas ten en cuenta las necesidades o hasta donde quieres llegar</p>
            </div>
        </div>
        <div class="row justify-content-center" id="paqueteAnual">

            <div class="col-md-4">
                <div class="col-md-12 mb-lg-0 mb-4">

                    <!-- Card -->
                    <div class="card">

                        <!-- Content -->
                        <div class="card-body">

                            <!-- Offer -->
                            <h5 class="mb-4 text-center">Plan Basico</h5>
                            <div class="d-flex justify-content-center">
                                <div class="card-circle d-flex justify-content-center align-items-center">
                                    <i class="fas fa-home indigo-text" style="font-size: 2em;"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bold my-4 text-center">59$</h2>
                            <p class="grey-text"><i class="fas fa-star"></i> Registro de Servicio</p>
                            <p class="grey-text"><i class="fas fa-star"></i> Unica publicación</p>
                            <p class="grey-text"><i class="fas fa-star"></i> Registro de Servicio</p>
                            <a class="btn btn-indigo btn-rounded btn-block">Registrarme</a>
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
        $(document).ready(function() {
            traerPosts();

            function traerPosts() {
                $.ajax({
                    type: "POST",
                    url: ruta + 'php/publico.php',
                    dataType: "json",
                    data: 'opcion=traerPlanes',
                    error: function(xhr, resp) {
                        console.log(xhr.responseText);
                    },
                    success: function(data) {
                        if (data.respuesta == 'exito') {
                            let cuerpoMes ="";
                            let cuerpoAnio ="";
                            for (const i in data.planes) {
                                if (data.planes[i].plan.tipo == 'Mensual') {
                                    cuerpoMes+=cuerpoPaquete(data.planes[i],ruta);
                                } else if (data.planes[i].plan.tipo == 'Anual') {
                                    cuerpoAnio+=cuerpoPaquete(data.planes[i],ruta);
                                }
                            }
                            $("#paqueteBasico").html(cuerpoMes);
                            $("#paqueteAnual").html(cuerpoAnio);
                        } else {

                        }
                    }
                });
            }

            function cuerpoPaquete(paquete, ruta) {
                var cuerpo = ``;
                let nombre = normalize(paquete.plan.nombre);
                let nombreMin = nombre.replace(" ", "-");


                cuerpo += `
                <div class="col-md-4 my-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-center">Plan ${paquete.plan.tipo} ${paquete.plan.nombre} </h5>
                            <div class="d-flex justify-content-center">
                                <div class="card-circle d-flex justify-content-center align-items-center">
                                    <i class="${paquete.plan.icono} ${paquete.plan.iconColor}" style="font-size: 4em;"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bold my-4 text-center">${paquete.plan.costo}$ <sub class="grey-text" style="font-size: .5em;">mes</sub></h2>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> Registro de Servicio</p>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> ${paquete.plan.publicacion} ${(paquete.plan.publicacion>1)?"publicaciones ":"publicación"}</p>
                            <p class="grey-text"><i class="fas fa-star text-warning"></i> Registro de Servicio</p>
                            <a href="${ruta}planes/${paquete.plan.id}/${nombreMin}"class="btn ${paquete.plan.bgColor} ${paquete.plan.textColor} btn-rounded btn-block waves-effect waves-light">Registrar</a>
                        </div>
                    </div>
                </div>
            `;
                return cuerpo;
            }
        });
    </script>
</body>

</html>