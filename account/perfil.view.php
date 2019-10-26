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
        <div class="row justify-content-end">
            <div class="col-md-7">
                <h2 class="h1-responsive font-weight-bold text-center my-5">Bienvenido, <?php echo $UserLogin['nombre'] . ' ' . $UserLogin['apellidos']; ?></h2>
            </div>
            <div class="col-md-5 text-center">
                <div class="btn-group responsive font-weight-bold text-center my-5">
                    <button class="btn btn-danger btn-lg btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones <span class="ml-2"><i class="fas fa-cog " aria-hidden="true"></i> </span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="green-text mr-4"><i class="fas fa-plus"></i></span> Crear publicación</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/config"><span class="blue-text mr-4"><i class="fas fa-user-circle"></i></span> Editar perfil</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="purple-text mr-4"><i class="fas fa-shopping-bag"></i></span> Cambiar plan</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="orange-text mr-4"><i class="fas fa-chart-line"></i></span> Ver estadisticas (Veta)</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="text-danger mr-4"><i class="fas fa-door-closed"></i></span> Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="magazine-section mt-2 mb-5">
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="single-news mb-lg-0 mb-">
                                <div class="view overlay rounded-circle z-depth-1-half mb-4">
                                    <img src="<?php echo fotoPerfil($UserLogin, $ruta); ?>" alt="Image Profile" style="width: 100%;">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                            </div>
                            <!-- Featured news -->

                        </div>
                        <div class="col-md-6">

                            <!-- Featured news -->
                            <div class="single-news mb-lg-0 mb-5 pt-5 ">
                                <div class="news-data d-flex justify-content">
                                    <a href="#!" class="deep-blue-text">
                                        <h6 class="font-weight-bold" id="servicioPerfil"><i class="fas fa-code pr-2"></i>Desarrollador</h6>
                                    </a>
                                    <p class="font-weight-bold dark-grey-text text-right"id="fechaPerfil"><i class="fas fa-clock-o pr-2"></i>27/02/2018</p>
                                </div>

                                <!-- Excerpt -->
                                <h3 class="font-weight-bold dark-grey-text mb-3"><a>Freelancer</a></h3>
                                <p class="dark-grey-text mb-lg-0 mb-md-5 mb-4">Anexo una descripción con un lorem de lo que se escribir y redarcar muchas gracias por su atención <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sed ullam ea.</p>
                                </p>

                            </div>
                            <!-- Featured news -->

                        </div>

                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="magazine-section">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row p-3">
                                <div class="col-md-12  rounded-lg z-depth-1-half ">
                                    <!--Section: Contact v.2-->
                                    <section class="mb-4">

                                        <!--Section heading-->
                                        <h2 class="h2-responsive font-weight-bold text-center my-4">Nueva Publicación
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
                                                                        <input type="text" id="titulo" name="titulo" class="form-control">
                                                                        <label for="titulo" class="">Título</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 opciones oculta">
                                                                    <div class="md-form">
                                                                        <textarea type="text" id="descripcion" name="descripcion" class="form-control md-textarea"></textarea>
                                                                        <label for="descripcion">Descripción</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-4 opciones oculta">
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
                            <div class="row mt-5" id="cuerpoPublicaciones">
                                <div class="col">
                                    <p>Cargando ... </p>
                                    <div class="progress">
                                        <div id="progressPub" class="progress-bar progress-bar-striped progress-bar-animated unique-color" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" style="width: 3%">
                                            3%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 my-4 p-2">
                                    <div class="bg-dark"><br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br></div>
                                </div>
                                <div class="col-lg-6 col-md-12 my-4 p-2">
                                    <div class="bg-dark"><br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-0" id="cuerpoRigth">
                            <h2 class="">Más publicaciones</h2>
                            <div class="row mt-5">
                                <div class="col-3">
                                    <div class="view overlay rounded mb-lg-0 mb-4 p-0">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-9">
                                    <p class="font-weight-bold dark-grey-text">
                                        <span>17/08/2018</span>
                                        <a href="#!"><span class="ml-4 m-0 badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Aventura</span></a>
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Voluptatem accusantium doloremque</a>
                                        </div>
                                        <a><i class="fas fa-angle-double-right"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-3">
                                    <div class="view overlay rounded mb-lg-0 mb-4 p-0">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-9">
                                    <p class="font-weight-bold dark-grey-text">
                                        <span>17/08/2018</span>
                                        <a href="#!"><span class="ml-4 m-0 badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Aventura</span></a>
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Voluptatem accusantium doloremque</a>
                                        </div>
                                        <a><i class="fas fa-angle-double-right"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-3">
                                    <div class="view overlay rounded mb-lg-0 mb-4 p-0">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-9">
                                    <p class="font-weight-bold dark-grey-text">
                                        <span>17/08/2018</span>
                                        <a href="#!"><span class="ml-4 m-0 badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Aventura</span></a>
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Voluptatem accusantium doloremque</a>
                                        </div>
                                        <a><i class="fas fa-angle-double-right"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-3">
                                    <div class="view overlay rounded mb-lg-0 mb-4 p-0">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-9">
                                    <p class="font-weight-bold dark-grey-text">
                                        <span>17/08/2018</span>
                                        <a href="#!"><span class="ml-4 m-0 badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Aventura</span></a>
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Voluptatem accusantium doloremque</a>
                                        </div>
                                        <a><i class="fas fa-angle-double-right"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Grid row -->

                </section>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Modifica tu imagen</h5>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="crop">Guardar</button>
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
    <script src="<?php echo $ruta; ?>script/publicacion.js"></script>
</body>

</html>