<?php
$CROOPER = true;
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
            <div class="col-md-7">
                <h2 class="h1-responsive font-weight-bold text-center my-5">Bienvenido, <?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row p-3">
                                <div class="col-md-12  rounded-lg z-depth-1-half ">
                                    <!--Section: Contact v.2-->
                                    <section class="mb-4">

                                        <!--Section heading-->
                                        <h2 class="h2-responsive font-weight-bold text-center my-4">Crear Servicio
                                        </h2>
                                        <div class="row">

                                            <!--Grid column-->
                                            <div class="col-md-12 mb-md-0 mb-5 ">
                                                <form id="formPublicacion" name="contact-form" action="" method="POST">
                                                    <div class="row">
                                                        <!--Grid column-->
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="md-form mb-0">
                                                                        <input type="text" id="nombre" name="nombre" class="form-control">
                                                                        <label for="nombre" class="">Nombre</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="md-form mb-0">
                                                                        <input type="text" id="color" name="color" class="form-control">
                                                                        <label for="color" class="">Color</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="md-form mb-0">
                                                                        <input type="text" id="icono" name="icono" class="form-control">
                                                                        <label for="icono" class="">Icono</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="md-form mb-0">
                                                                        <input type="text" id="descripcion" name="descripcion" class="form-control">
                                                                        <label for="descripcion" class="">Descripción</label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-4">
                                                            <label class="label aqua-gradient rounded " data-toggle="tooltip" title="Agregar imagen" style="width: 100%; cursor: pointer;">
                                                                <img class="rounded z-depth-3 mt-0 pt-0" id="avatar" src="<?php echo $ruta; ?>galeria/sistema/images/imgdefault.png" alt="avatar" style="width: 100%;">
                                                                <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                                                            </label>
                                                            <div class="progress" id="progresoPub">
                                                                <div id="progresoPubBarra" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                            </div>
                                                            <div class="alert" role="alert"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-8">
                                                            <button class="btn btn-primary btn-block" type="submit">Publicar</button>
                                                        </div>
                                                        <div class="col-2">
                                                            <div id="cancelar" class="btn btn-danger btn-block text-center" type="submit"><i class="fas fa-window-close"></i></div>
                                                        </div>
                                                    </div>
                                                    <!--Grid row-->
                                                </form>
                                                <div class="status"></div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--Section: Contact v.2-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Grid row -->

                </section>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Nombre</th>
                            <th class="th-sm">Imagen</th>
                            <th class="th-sm">Color</th>
                            <th class="th-sm">Descripcion</th>
                            <th class="th-sm">Icono</th>
                            <th class="th-sm">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tablaServicios">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="image" src="<?php echo $ruta; ?>galeria/sistema/images/default.png" style="width: 100%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'templates/footer.view.php'; ?>
    <?php require_once 'templates/footer.php'; ?>
    <script>
        new WOW().init();
        $(".wow").on('click', (e) => {
            e.preventDefault();
        });
    </script>
    <script src="<?php echo $ruta; ?>account/admin/servicios/servicios.js"></script>
    
</body>

</html>