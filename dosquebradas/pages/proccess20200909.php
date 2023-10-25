<? session_start();

include("../funciones/funciones.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.::::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body onLoad="JavaScript:document.form.submit();">


Procesando informacion.....

<!--<form  name="form" action="https://www.abcpagos.com/PRUEBASPSE3/index.jsp" method="post">-->
<form  name="form" action="https://www.abcpagos.com/PSE5/faces/index.xhtml" method="post">
          <input type='hidden' name='ticket' value="<?=$_SESSION["ticket"];?>">
          <input type='hidden' name='amount' value="<?=$_SESSION["total"];?>">
          <input type='hidden' name='vatAmount' value="0">
          <input type="hidden" name="cod_empresa" value="<?=$_SESSION["empresa"];?>">
          <input type='hidden' name='serviceCode' value="<?=$_SESSION["serviceCode"]?>">
          <input type='hidden' name='nit' value="8000993106">
          <input type='hidden' name='razonSocial' value="Municipio_de_Dos_Quebradas">
          <input type="hidden" name="url" value="http://www.dosquebradas.gov.co/web/">
          <input type="hidden" name="sitio" value="Municipio de Dos Quebradas">
          <input type='hidden' name='paymentDescription' value="<?=$_SESSION["concepto"];?>">
  	      <input type='hidden' name='reference' value="<?=$_SESSION["referencia"];?>">
          <input type='hidden' name='reference1' value="<?=$_SERVER['REMOTE_ADDR'];?>">
          <input type='hidden' name='reference2' value="<?=$_SESSION["identificacion"]?>">
          <input type='hidden' name='reference3' value="<?=$_SESSION["tipo_documento"]?>">
          <input type='hidden' name="ficha" value="<?php echo getFicha($_SESSION['total'],$_SESSION['referencia']) ?>" />

</form>
<? session_destroy();?>
</body>
</html>
