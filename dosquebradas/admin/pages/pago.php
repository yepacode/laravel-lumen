<?
session_start();
include_once("../../funciones/conexion.php");
include_once("../../funciones/funciones.php");
$msg="";

if($_REQUEST["descargar"]==1){
   header('Content-Description: File Transfer');
   header("Content-type: application/vnd.ms-excel"); 
   header("Content-Disposition: attachment; filename=informe_transacciones.xls"); 
   header("Pragma: no-cache"); 
   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   header("Expires: 0"); 
   header('Pragma: public');		
}else{
	?>
	<a href="./pages/pago.php?generar=1&fechaini=<?=$_REQUEST["fechaini"]?>&fechafin=<?=$_REQUEST["fechafin"]?>&descargar=1" >Descargar Archivo Excel</a>&nbsp;
	<span onclick="window.location='pages/plano.php?fechaini=<?=$_REQUEST["fechaini"]?>&fechafin=<?=$_REQUEST["fechafin"]?>'" class="lnk">Descargar Archivo Plano</span>
	<? 
}
/*$keys=array_keys($_POST);
 foreach($keys as $k){
  echo $k.'='.$_POST[$k].'<br>';
  }*/
if($_REQUEST['generar'] && $_REQUEST['fechaini'] && $_REQUEST['fechafin']){
$listado=getPagosHechos($_REQUEST['fechaini'], $_REQUEST['fechafin']);
//print_r($listado);
?>
 <table width="866" border="1" cellpadding="2" cellspacing="1">
   <tr height="20">

    <td width="36" align="center">Nº</td>
    <td width="93" align="center">No. Documento </td>
    <td width="235" align="center">Banco</td>
    <td width="80" align="center">Valor</td>
    <td width="61" align="center">Fecha Pago</td>
    <td width="100" align="center">Referencia de pago</td>
    <td width="118" align="left">Detalle de la referencia</td>
    <td width="84" align="left">Valor Detalle</td>
  </tr>
<?
$num=1;
for($i=0;$i<count($listado);$i++){
	//$recibo=getDatosRecibo($listado[$i]['referencia']);
	//print_r($listado);
	$transac=getDatosTransac($listado[$i]['referencia']);
	$j=0;
	do{
	//print_r($transac);
	
	//echo '<br>ref '.$recibo[$i]['referencia'];
	//echo '<br>id '.$recibo['identificacion'];
	//echo '<br>dato usuario<br>';

?>
   <tr height="20">
    <td align="center" valign="middle"><?=$num;?></td>
	<td align="left"><?=$listado[$i]['documento'];?></td>
    <td align="justify"><?=$listado[$i]['banco']." ".$listado[$i]["cus"];?></td>
    <td align="right"><?=number_format($listado[$i]['valor'],'0',',',',')?></td>
    <td align="right"><?=$listado[$i]['fecha_fin']?></td>
    <td align="left"><?=substr($listado[$i]['referencia'],0,-1);?></td>
    <td align="left"><?=$transac[$j]['detalle'];?></td>
    <td align="right"><?=number_format($transac[$j]['valor_detalle'],'0',',',',')?></td>
   </tr>

<?   $j++;
	$num++;
}while($transac[$j]['num_obligacion'] == $listado[$i]['referencia']);
	}?>

 <p>&nbsp;</p>
 <tr>
	<td height="25" colspan="8" align="center">&nbsp;<?=$msg?></td>
</tr>
</table>
<? }?>
<div id="cp_plano"></div>