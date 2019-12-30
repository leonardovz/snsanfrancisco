var MESES = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

function rellenarCero(numero, ceros = 5) {
    let cadena = "";
    for (let i = numero.length; i < ceros; i++) {
        cadena += '0';
    }
    cadena += numero;
    return cadena;
}
function removeSpecialChars(str) {
    return str.replace(/(?!\w|\s)./g, '')
        .replace(/\s+/g, ' ')
        .replace(/^(\s*)([\W\w]*)(\b\s*$)/g, '$2')
        .replace(/ /g, "-")
        .trim();
}
var normalize = (function () {
    var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÇç",
        to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuucc",
        mapping = {};

    for (var i = 0, j = from.length; i < j; i++)
        mapping[from.charAt(i)] = to.charAt(i);

    return function (str) {
        var ret = [];
        for (var i = 0, j = str.length; i < j; i++) {
            var c = str.charAt(i);
            if (mapping.hasOwnProperty(str.charAt(i)))
                ret.push(mapping[c]);
            else
                ret.push(c);
        }
        return ret.join('');
    }

})();
function wowElement() {
    $(".wow").off().on('click', (e) => {
        e.preventDefault();
    });
}
function fechaFormato(fecha) {
    /* Recibe una fecha en el formato yyyy-mm-dd */
    fecha = fecha.split("-"),
        dia = parseInt(fecha[2]),
        mes = parseInt(fecha[1]),
        anio = parseInt(fecha[0]);
    return [dia, mes, anio];
}
function alertaSwal(texto, tipo, tiempo = 1500) {
    Swal.fire({
        position: 'top-end',
        type: tipo,
        title: texto,
        showConfirmButton: false,
        timer: tiempo
    })
}

$(".inBusqueda").change(function (e) {
    e.preventDefault();
    let RUTAF = rutaFILES();
    var buscar = normalize($(this).val());
    window.location = RUTAF + 'buscar/' + buscar.replace(/ /g, "-");
});

