<? session_start();
 if($_SESSION["ses_id"]==""){
?>
<script>
 window.location='index.php';
</script>
<?
 }
?>
<? 

require_once("../../funciones/conexion.php");
require_once("../../funciones/funciones.php");

?>
<br />
<table width="601" height="400" border="0" align="center" class="cajaGris">
  <tr>
    <td width="595"  height="10" class="barraTitulo">PAGOS REALIZADOS</td>
  </tr>
  <tr>
    <td align="center"  height="30"  ><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Desde</td>
        <td><input type="text" name="fechaini" id="fechaini" onfocus='Calendar.setup({inputField:"fechaini",ifFormat:"%Y-%m-%d",button:"calen"});' readonly="true" /></td>
        <td>Hasta</td>
        <td><input type="text" name="fechafin" id="fechafin"   onfocus='Calendar.setup({inputField:"fechafin",ifFormat:"%Y-%m-%d",button:"calen"});' readonly="true"/></td>
        <td align="center"><label>
          <input type="button" name="generar" value="Reporte" class="btn" onclick="FAjax('pages/pago.php','pagos','','post')"/>
        </label></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  height="260"  align="center"  class="titulo"><div id="pagos"></div></td>
  </tr>
</table>
		