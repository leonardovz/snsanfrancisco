<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar bg-dark mb-5">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $ruta; ?>">
            <strong>SnSanfrancisco</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo ((!$rutas) ? " active " : ""); ?>">
                    <a class="nav-link" href="<?php echo $ruta; ?>">Inicio
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item <?php echo (($rutas && $rutas[0] == 'servicios') ? " active " : ""); ?> ">
                    <a class="nav-link" href="<?php echo $ruta; ?>servicios">Servicios</a>
                </li>
                <li class="nav-item <?php echo (($rutas && $rutas[0] == 'blog') ? " active " : ""); ?> ">
                    <a class="nav-link" href="<?php echo $ruta; ?>blog">Blog</a>
                </li>
                <li class="nav-item <?php echo (($rutas && $rutas[0] == 'planes') ? " active " : ""); ?> ">
                    <a class="nav-link" href="<?php echo $ruta; ?>planes">Planes</a>
                </li>
            </ul>
            <form class="form-inline">
                <div class="md-form mt-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                </div>
            </form>
            <?php if ($UserLogin) { ?>
                <div class="btn-group responsive font-weight-bold text-center">
                    <button class="btn-floating btn-lg btn-outline-white ml-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="ml-2"><i class="fas fa-user"></i></i> </span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="green-text mr-4"><i class="fas fa-plus"></i></span> Crear publicación</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil/config"><span class="blue-text mr-4"><i class="fas fa-user-circle"></i></span> Editar perfil</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>planes"><span class="purple-text mr-4"><i class="fas fa-shopping-bag"></i></span> Cambiar plan</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil"><span class="orange-text mr-4"><i class="fas fa-chart-line"></i></span> Ver estadisticas (Veta)</a>
                        <a class="dropdown-item" href="<?php echo $ruta; ?>perfil" id="cerrarSesion"><span class="text-danger mr-4"><i class="fas fa-door-closed"></i></span> Cerrar Sesión</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="<?php echo $ruta; ?>login" class="btn-floating btn-lg btn-outline-white ml-4"><i class="fas fa-user"></i></a>
            <?php } ?>

        </div>
    </div>
</nav>