new WOW().init();
$(".wow").on('click', (e) => {
    e.preventDefault();
});
var ruta = ruta();
$(document).ready(() => {
    formLogin();
    function evitarCarga() {
        $("#formLogin").off().on('submit', function (e) {
            e.preventDefault();
            alert("Quieto perro");
        })
    }
    function formLogin() {
        $("#formLogin").off().on('submit', function (e) {
            e.preventDefault();
            evitarCarga();
            var formulario = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: ruta + 'php/usuariosAJAX.php',
                data: 'opcion=login&' + formulario,
                dataType: 'json',
                error: function (xhr, status) {
                    console.log(JSON.stringify(xhr));
                    formLogin();
                },
                success: function (data) {
                    if (data.respuesta == 'exito') {
                        Swal.fire(
                            'Exito!',
                            data.Texto,
                            'success'
                        );
                        setInterval(() => { location.reload() }, 1500);
                    } else {
                        Swal.fire(
                            'Alerta!',
                            data.Texto,
                            'error'
                        );
                    }
                    formLogin();
                }
            });
        });
    }
    /*///////////////////////////////
        BOTÓN DE FACEBOOK
    *////////////////////////////////
    // $("#loginFacebook").on('click', function (e) {
    //     e.preventDefault();
    //     FB.login(function () {
    //         validarUsuario();
    //     }, { scope: 'public_profile,email' })
    // });

    //VALIDAR INGRESO
    function validarUsuario() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        })

    }
    function statusChangeCallback(response) {
        // console.log(response);
        if (response.status === "conected") {
            testApi();
        } else {
            Swal.fire(
                'ERROR!',
                '¡ Ocurrio un error al Ingresar con Facebook, por favor vuelve a intentarlo!',
                'success'
            );
        }
    }

    function testApi() {
        FB.api('/me?fields=id,name,email,picture', function (response) {
            if (response.email == 'undefined') {
                Swal.fire(
                    'ERROR!',
                    '¡Para ingresar al sistema debes de proporcionar tu correo electrónico!',
                    'success'
                );
            } else {
                var email = response.email;
                var name = response.name;
                var foto = 'https://graph.facebook.com/' + response.id + '/picture?type=large';
                var datos = new FormData();
                datos.append('email', email);
                datos.append('nombre', name);
                datos.append('foto', foto);
                // console.log(datos);
            }
        });
    }

    /*///////////////////////////////
           BOTÓN DE FACEBOOK
    ///////////////////////////////*/

    $("#loginGoogle").on('click', function (e) {
        e.preventDefault();

    });

});
