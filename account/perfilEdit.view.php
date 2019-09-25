<?php
$CROOPER = true;
require_once 'templates/header.php'; ?>

<body>
    <style>
        .label {
            cursor: pointer;
        }

        .progress {
            display: none;
        }

        .alert {
            display: none;
        }

        .img-container img {
            max-width: 100%;
        }
    </style>
    <!-- Main navigation -->
    <header class="mb-5">
        <!--Navbar-->
        <?php require_once 'templates/header.view.php'; ?>

        <br><br>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="magazine-section my-5">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Card Dark -->
                            <div class="card">
                                <div class="view overlay">
                                    <label class="label" data-toggle="tooltip" title="Change your avatar" style="width: 100%;">
                                        <img class="rounded" id="avatar" src="<?php echo fotoPerfil($UserLogin,$ruta);?>" alt="avatar" style="width: 100%;">
                                        <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                                    </label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div class="alert" role="alert"></div>
                                </div>
                                <div class="card-body elegant-color white-text rounded-bottom">
                                    <a class="activator waves-effect mr-4"><i class="fas fa-share-alt white-text"></i></a>
                                    <a class="activator waves-effect mr-4 text-primary" id="editarFoto"><i class="fas fa-edit"></i></a>
                                    <a class="activator waves-effect mr-4 text-danger"><i class="fas fa-trash-alt"></i></i></a>
                                </div>

                            </div>
                            <!-- Card Dark -->
                        </div>
                        <div class="col-md-8">
                            <!-- Default form subscription -->
                            <form class="text-center border border-light p-5" action="#!">

                                <p class="h4 mb-4"><?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></p>

                                <p>Aquí puedes modificar los datos de tu perfil.</p>

                                <!-- Name -->
                                <input type="text" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $UserLogin['nombre']; ?>">

                                <!-- Email -->
                                <input type="text" id="apellidos" class="form-control mb-4" placeholder="Apellidos" value="<?php echo $UserLogin['apellidos']; ?>">

                                <!-- Sign in button -->
                                <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>


                            </form>
                            <!-- Default form subscription -->
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-8">
                            <!-- Default form subscription -->
                            <form class="text-center border border-light p-5" action="#!">

                                <p class="h4 mb-4">Opciones de tu plan</p>

                                <p>Aquí puedes modificar los datos de tu perfil.</p>

                                <!-- Name -->
                                <input type="text" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $UserLogin['nombre']; ?>">

                                <!-- Email -->
                                <input type="text" id="apellidos" class="form-control mb-4" placeholder="Apellidos" value="<?php echo $UserLogin['apellidos']; ?>">

                                <!-- Sign in button -->
                                <button class="btn btn-info btn-block" type="submit">Guardar Cambios</button>


                            </form>
                            <!-- Default form subscription -->
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row p-3">

                            </div>
                        </div>
                    </div>

                </section>
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
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
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

    <script src="<?php echo $ruta; ?>/script/perfil.js"></script>

</body>

</html>