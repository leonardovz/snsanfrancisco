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
            <div class="col-12">
                <button class="btn btn-light-blue generarCodigo"> Generar Código</button>
            </div>
            <div class="col-12" id="vistaForm" style="display: none;">
                <!-- Default form contact -->
                <form class="text-center border border-light p-5" id="generarCodigos">

                    <p class="h4 mb-4">Datos de Creación</p>

                    <!-- Name -->
                    <label>Asignación de Usuario</label>
                    <select id="idUsuarioSel" name="idUsuario" class="browser-default custom-select mb-4">
                    </select>
                    <!-- Email -->
                    <!-- Subject -->
                    <label>Seleccióna el Paquete</label>
                    <select id="paqueteVal" name="paquete" class="browser-default custom-select mb-4">
                    </select>
                    <label>Cantidad de paquetes a asignar</label>
                    <input type="number" id="cantidad" class="form-control mb-4" placeholder="Cantidad">

                    <!-- Send button -->
                    <button class="btn btn-info btn-block" type="submit">Registrar</button>
                    
                </form>
                <button class="btn btn-danger cerrarForm" type="submit">Cerrar</button>
                <!-- Default form contact -->
            </div>
            <div class="col" id="dablaCodigos">
                <table class="table">
                    <thead class="black white-text">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Creación</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
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
        $(".generarCodigo").on('click',function(){
            $("#vistaForm").show();
        });
        $(".cerrarForm").on('click',function(){
            $("#vistaForm").hide();
        });
    </script>
    <script src="<?php echo $ruta; ?>account/admin/codigos/codigos.js"></script>
    <script>

    </script>
</body>

</html>