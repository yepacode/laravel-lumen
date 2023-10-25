<? session_start();
include("../funciones/conexion.php");
require("../funciones/funciones.php");
$empresa=$_POST["cod_empresa"];
$fecha = new DateTime();
$_SESSION["ticket"]= $codempresa . $fecha->getTimestamp();
$_SESSION["total"]=$_POST["amount"];
$_SESSION["iva"]=$_POST["vatAmount"];
$_SESSION["concepto"]=str_replace(" ","_",$_POST["paymentDescription"]);
$_SESSION["referencia"]=$_POST["reference1"];
$_SESSION["identificacion"]=$_POST["reference2"];
$_SESSION["tipo_documento"]=str_replace(" ","_",$_POST["reference3"]);
$_SESSION["empresa"]=$_POST["cod_empresa"];
$_SESSION["ficha"] =  $ficha=getFicha($_SESSION["total"],$_POST["reference1"]);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr align="center">
    <td height="287" colspan="3" valign="top">      <table border="0" height="60" cellspacing="0" cellpadding="0" class="BordeTablaNegro">

        <tr>
          <td height="24" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td height="8" align="center">

             <iframe src="pages/proccess.php" scrolling="auto"  frameborder="0" width="650"  height="1200" ></iframe>

          </td>
        </tr>
        <tr>
          <td height="8" align="center">&nbsp;</td>
        </tr>
        </table>

