<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><script language="JavaScript" type="text/javascript" src="./funciones/ajax.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pago En Linea</title>
<link href="./css/estilos.css" rel="stylesheet" type="text/css" />

<?php

if($_REQUEST["cus"]){
?>
<script language="javascript">

	window.close()

</script>
<?php
}
?>
</head>

<body>
<form name="form" id="form" action="#" method="post">
  <table width="80" height="550"  align="center"  >
    <tr>
      <td  valign="top"><div id="encabezado"><?php include('./encabezado.php');?></div></td>
    </tr>
    <tr>
      <td align="center"><div id="cp_credibanco">
        <div id="cuerpo">
		   <?php include('pages/pse.php');?></div>
         </div>
         </td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3" background="imagenes/barra-punteada.jpg"><img src="imagenes/spacer.gif" border="0" width="1" height="2"  alt="" /></td>
        </tr>
        <tr>
          <td><div id="pie" align="left" style="margin-left: 20px;" class="BlackLinkText"></div></td>
          <td align="center"><div id="pie1" align="center"></div></td>
          <td></td>
        </tr>
      </table></td>
    </tr>
  </table>

</form>





















</body>
</html>
