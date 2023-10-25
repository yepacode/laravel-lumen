<? session_start();

include_once("../../funciones/conexion.php");
include_once("../../funciones/funciones.php");

$listado=getPagosHechos($_REQUEST['fechaini'], $_REQUEST['fechafin']);

for($i=0;$i<count($listado);$i++) {
	$fecha=substr($listado[$i]['fecha_fin'],0,10);
	$fecha=str_replace('-','',$fecha);
	$valor=str_replace('.','',$listado[$i]['valor']);
	$txt.=
		 getCompletarCeros(3, 111).
		 getCompletarCeros(8, $fecha).
		 getCompletarCeros(2, "DE").
		 getCompletarCeros(8, 0).	//$listado[$i]['documento']).
		 getCompletarCeros(11, $valor).
		 getCompletarCeros(11, 0).
		 getCompletarCeros(15, $valor).
		 getCompletarCeros(4, substr($listado[$i]['cus'],-4)).
		 getCompletarCeros(24, substr($listado[$i]['referencia'],0,-1)).
		 getCompletarCeros(24, 0)."\r\n";	
 }
$archivo="archivos/pagos_leasing.txt";
header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$archivo);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));

$fp=fopen($archivo,"w");
fwrite($fp,$txt);
fclose($fp) ;
echo $txt;

?>
