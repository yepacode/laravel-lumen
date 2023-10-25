<?php
session_start();
include("../funciones/conexion.php");
require("../funciones/funciones.php");


$_SESSION["tipo_documento"] = str_replace(" ", "_", $_POST["tipoDocumento"]);
$_SESSION["referencia"] = $_POST["referencia"];
$_SESSION["identificacion"] = $_POST["identificacion"];
$_SESSION["nombre"] = $_POST["nombre"];
$_SESSION["valor"] = $_POST["valor"];
$_SESSION["concepto"] = str_replace(" ", "_", $_POST["concepto"]);
$_SESSION["codigoServicio"] = $_POST["codigoServicio"];
$_SESSION["codigoEntidad"] = $_POST["codigoEntidad"];
$_SESSION["iva"] = $_POST["iva"];
$fecha = new DateTime(); 
$_SESSION["ticket"] =$ticket = $_POST["codigoEntidad"] . $fecha->getTimestamp();

$_SESSION["nit"] = "8918008461";
$_SESSION["razonSocial"] = "Municipio Dos Quebradas";
$_SESSION["sitio"] = "Dos Quebradas";
$fichaCompleta = $_SESSION["ficha"];
$fichaRecortada = substr($fichaCompleta, 0, 17);

$_SESSION["ficha"] =  getFicha($_POST["valor"], $_POST['referencia']);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr align="center">
        <td height="287" colspan="3" valign="top">
            <table border="0" height="60" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="24" align="right">&nbsp;</td>
                </tr>
               
                <tr>
                    <td height="8" align="center">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<!-- se redirecciona -->
<script type="text/javascript">
    window.location.href = "pages/proccess.php";
</script>