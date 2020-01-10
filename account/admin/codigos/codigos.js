var ruta = ruta();
$(document).ready(function () {
    $("#generarCodigos").on('submit', function (e) {
        e.preventDefault();
        var $formulario = $(this).serialize();
        Swal.fire({
            title: 'Estas seguro',
            text: "Estas apunto de crear un nuevo código",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si,Crear'
        }).then((result) => {
            if (result.value) {
                crearCodigo($formulario);
            }
        })
    });
    traerPlanes();
    traerPerfiles();
    traerPaquetes();
    function crearCodigo(formulario) {
        $.ajax({
            type: "POST",
            url: ruta + 'php/adminFunciones.php',
            dataType: "json",
            data: 'opcion=generarCodigo&' + formulario,
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                if(data.respuesta=="exito"){
                    alertaSwal(data.Texto,'success');
                    traerPaquetes();
                }else{
                    alertaSwal(data.Texto,'error');

                }
            }
        });
    }
    function traerPlanes() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publico.php',
            dataType: "json",
            data: 'opcion=traerPlanes',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                if (data.respuesta = "exito") {
                    let cuerpo = "";
                    for (const i in data.planes) {
                        cuerpo += `<option value="${data.planes[i].plan.id}">${data.planes[i].plan.nombre} ${data.planes[i].plan.tipo}</option>`;
                    }
                    $("#paqueteVal").html(cuerpo);
                }
            }
        });
    }
    function traerPerfiles() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/publicacionesAJAX.php',
            dataType: "json",
            data: 'opcion=traerPerfiles',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                if (data.respuesta = "exito") {
                    let cuerpo = "";
                    cuerpo += `<option value="0">No asignar</option>`;
                    for (const i in data.perfiles) {
                        cuerpo += `<option value="${data.perfiles[i].idUsuario}">${data.perfiles[i].nombre} ${data.perfiles[i].apellidos} -|- ${data.perfiles[i].correo}</option>`;
                    }
                    $("#idUsuarioSel").html(cuerpo);
                }
            }
        });
    }
    function traerPaquetes() {
        $.ajax({
            type: "POST",
            url: ruta + 'php/usuariosFunciones.php',
            dataType: "json",
            data: 'opcion=traerPaquetes',
            error: function (xhr, resp) {
                console.log(xhr.responseText);
            },
            success: function (data) {
                $("#dablaCodigos").html(cuerpoTabla(data.codigos));

            }
        });
    }
    function cuerpoTabla(codigos) {
        let cuerpo = `
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
            <tbody>`;
        for (let i in codigos) {
            cuerpo += `
                <tr>
                    <th scope="row">${codigos[i].id}</th>
                    <td>${codigos[i].codigo}</td>
                    <td>${codigos[i].creacion.split(' ')[0]}</td>
                    <td>${codigos[i].nombreR}</td>
                    <td>${codigos[i].cantidad}</td>
                    <td>${codigos[i].estado}</td>
                </tr>
                `;
        }

        cuerpo += `
            </tbody>
        </table>`;
        return cuerpo;
    }
});