<?
session_start();
include("./funciones/conexion.php");
include("./funciones/funciones.php");
$estado=$_GET["estado"];
$id_registro=$_GET["id"];
$aprobacion=$_GET["aprobacion"];
$cus=$_GET["cus"];
$_SESSION["cus"]=$cus;
if($_GET["medio"]==3){
	$_SESSION["medio"]=$_GET["medio"];
} else {
	$_SESSION["medio"]=1;
}
if($estado=="OK"){
	updatePagos($id_registro, $cus);
}
include("capa_get.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

</body>
</html>
