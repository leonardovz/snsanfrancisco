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
                                        <h6 class="font-weight-bold"><i class="fas fa-code pr-2"></i>Desarrollador</h6>
                                    </a>
                                    <p class="font-weight-bold dark-grey-text text-right"><i class="fas fa-clock-o pr-2"></i>27/02/2018</p>
                                </div>

                                <!-- Excerpt -->
                                <h2 class="font-weight-bold dark-grey-text mb-3"><a>Leonardo Vázquez Angulo</a></h2>
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
                    <div class="row" id="cuerpoPublicaciones">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-5">

                                    <!-- Featured news -->
                                    <div class="single-news mb-3">

                                        <!-- Image -->
                                        <div class="view overlay rounded z-depth-2 mb-4">
                                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" alt="Sample image">
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-11 text-center pl-0 mb-3 ">
                                                <a class="font-weight-bold">Titulo de la publicación</a>
                                            </div>
                                        </div>
                                        <!-- Grid row -->
                                        <div class="row mb-3">

                                            <!-- Grid column -->
                                            <div class="col-12">
                                                <a href="#!"><span class="badge deep-orange"><i class="fas fa-plane pr-2" aria-hidden="true"></i>Travel</span></a> </div>
                                        </div>
                                    </div>
                                    <div class="single-news mb-3">

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-12 pl-0 text-justify ">
                                                <a>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est
                                                    accusamus
                                                    optio minima ab odio obcaecati perspiciatis ea vero eaque
                                                    repellendus, odit
                                                    tempore eos laboriosam velit aut exercitationem, error nesciunt
                                                    officia
                                                    recusandae, asperiores impedit blanditiis id facilis. Unde, neque
                                                    illo?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-5">

                                    <!-- Featured news -->
                                    <div class="single-news mb-3">

                                        <!-- Image -->
                                        <div class="view overlay rounded z-depth-2 mb-4">
                                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/31.jpg" alt="Sample image">
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-11 text-center pl-0 mb-3 ">
                                                <a class="font-weight-bold">Titulo de la publicación</a>
                                            </div>
                                        </div>
                                        <!-- Grid row -->
                                        <div class="row mb-3">

                                            <!-- Grid column -->
                                            <div class="col-12">
                                                <a href="#!"><span class="badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Adventure</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-news mb-3">

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-12 pl-0 text-justify ">
                                                <a>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est
                                                    accusamus
                                                    optio minima ab odio obcaecati perspiciatis ea vero eaque
                                                    repellendus, odit
                                                    tempore eos laboriosam velit aut exercitationem, error nesciunt
                                                    officia
                                                    recusandae, asperiores impedit blanditiis id facilis. Unde, neque
                                                    illo?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-5">

                                    <!-- Featured news -->
                                    <div class="single-news mb-3">

                                        <!-- Image -->
                                        <div class="view overlay rounded z-depth-2 mb-4">
                                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" alt="Sample image">
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-11 text-center pl-0 mb-3 ">
                                                <a class="font-weight-bold">Titulo de la publicación</a>
                                            </div>
                                        </div>
                                        <!-- Grid row -->
                                        <div class="row mb-3">

                                            <!-- Grid column -->
                                            <div class="col-12">
                                                <a href="#!"><span class="badge deep-orange"><i class="fas fa-plane pr-2" aria-hidden="true"></i>Travel</span></a> </div>
                                        </div>
                                    </div>
                                    <div class="single-news mb-3">

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-12 pl-0 text-justify ">
                                                <a>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est
                                                    accusamus
                                                    optio minima ab odio obcaecati perspiciatis ea vero eaque
                                                    repellendus, odit
                                                    tempore eos laboriosam velit aut exercitationem, error nesciunt
                                                    officia
                                                    recusandae, asperiores impedit blanditiis id facilis. Unde, neque
                                                    illo?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-5">

                                    <!-- Featured news -->
                                    <div class="single-news mb-3">

                                        <!-- Image -->
                                        <div class="view overlay rounded z-depth-2 mb-4">
                                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/31.jpg" alt="Sample image">
                                            <a>
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-11 text-center pl-0 mb-3 ">
                                                <a class="font-weight-bold">Titulo de la publicación</a>
                                            </div>
                                        </div>
                                        <!-- Grid row -->
                                        <div class="row mb-3">

                                            <!-- Grid column -->
                                            <div class="col-12">
                                                <a href="#!"><span class="badge pink"><i class="fas fa-camera pr-2" aria-hidden="true"></i>Adventure</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-news mb-3">

                                        <!-- Title -->
                                        <div class="d-flex justify-content-between">
                                            <div class="col-12 pl-0 text-justify ">
                                                <a>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est
                                                    accusamus
                                                    optio minima ab odio obcaecati perspiciatis ea vero eaque
                                                    repellendus, odit
                                                    tempore eos laboriosam velit aut exercitationem, error nesciunt
                                                    officia
                                                    recusandae, asperiores impedit blanditiis id facilis. Unde, neque
                                                    illo?</a>
                                            </div>
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
                        <div class="col-lg-4 col-md-6 mb-0">
                            <div class="row mb-5">


                                <div class="col">
                                    <div class="card-body contact text-center h-100 bg-primary white-text rounded z-depth-1">

                                        <h3 class="my-4 pb-2">Información de contacto</h3>
                                        <ul class="text-lg-left list-unstyled ml-4">
                                            <li>
                                                <p><i class="fas fa-map-marker-alt pr-2"></i>New York, 94126, USA</p>
                                            </li>
                                            <li>
                                                <p><i class="fas fa-phone pr-2"></i><a class="text-white h6" href="tel:1234 567 890">1234 567 890</a></p>
                                            </li>
                                            <li>
                                                <p><i class="fas fa-envelope pr-2"></i><a class="text-white h6" href="mailto:contact@example.com">contact@example.com</a> </p>
                                            </li>
                                        </ul>
                                        <hr class="hr-light my-4">
                                        <ul class="list-inline text-center list-unstyled">
                                            <li class="list-inline-item">
                                                <a class="p-2 fa-lg tw-ic">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="p-2 fa-lg li-ic">
                                                    <i class="fab fa-linkedin-in"> </i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="p-2 fa-lg ins-ic">
                                                    <i class="fab fa-instagram"> </i>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
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
</body>

</html>