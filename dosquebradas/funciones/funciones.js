function mostrar() {
    document.getElementById("encabezado").style.display = 'block';
    document.getElementById("pie").style.display = 'block';
    document.getElementById("botones").style.display = 'block';
    //document.getElementById("corregir").style.display='block';
    //document.getElementById("imprimir").style.display='block';
}
///////////////////////////////
function ocultar() {
    document.getElementById("encabezado").style.display = 'none';
    document.getElementById("pie").style.display = 'none';
    document.getElementById("botones").style.display = 'none';
    //document.getElementById("corregir").style.display='none';
    //document.getElementById("imprimir").style.display='none';
}
///////////////////////////////
function page_print() {
    ocultar();
    window.print();
    setTimeout("mostrar()", 200);
}
////////////////////////////////////////////////////
function Extract(Obj) {
    var str = Obj.replace(/,/g, "");
    if (str == "") {
        return "0";
    } else {
        return (str);
    }

}
///////////////////////////////////////////////
function formatCurrency(num) {
    num = num.toString().replace(/ |,/g, '');
    if (isNaN(num))
        num = "0";
    cents = Math.floor((num * 100 + 0.5) % 100);
    num = Math.floor((num * 100 + 0.5) / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
    return (num);
}


/////////////////////////////////////////////////////////////////
function validar_clave_admin(f) {

    if (f.nueva.value.length < 1) {
        alert("digite la nueva clave ")
        f.nueva.select();
        return false;
    }
    if (f.nueva.value != f.confirmacion.value) {
        alert("La nueva clave y la confirmacion no son iguales");
        f.confirmacion.select();
        return false;
    }
    f.cambiar.value = '1';
    FAjax('pages/cambiar_clave.php', 'principal', '', 'post');
}
/////////////////////////////////////////////////////////////////

function descargaConsolidado() {

    if (document.getElementById('txt_fecha_asobancaria').value === "") {
        alert('Debe ingresar la fecha');
    } else {
        window.location = "pages/asobancaria.php?descargar=1&txt_fecha_asobancaria=" + document.getElementById('txt_fecha_asobancaria').value + "", "ventana", "";
    }

}
///////////////////////////////////////////////

function procesa_tarjeta() {
    var form = document.getElementById("form");
    form.action = "https://www.abcpagos.com:8443/credibanco/procesar";
    form.submit();
}