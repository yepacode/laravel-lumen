<?php
 session_start();
//  echo "<pre>";
//  var_dump($_SESSION);
//  echo "</pre>";
//  var_dump($_SERVER['REMOTE_ADDR']);
//  die();
//die($pagina);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<?  	//onLoad="JavaScript:document.form.submit();"?>
<body onLoad="JavaScript:document.form.submit();">

Procesando informacion.....
 <!-- <form  name="form" action="https://www.abcpagos.com/PSE5/faces/index.xhtml" method="post"> pruebas -->
	<form  name="form" action="https://test.abcpagos.com/PSE/paymentProcessor" method="post" >

	
        <input type="hidden" name="referencia"			value="<?php echo  $_SERVER['REMOTE_ADDR']; ?>" />
		<input type='hidden' name='ticket'				value="<?php echo $_SESSION['ticket'] ?>">
		<input type='hidden' name='amount'				value="<?php echo $_SESSION["valor"]; ?>" />
		<input type='hidden' name='vatAmount'			value="<?php echo $_SESSION["iva"]; ?>" />
		<input type="hidden" name="cod_empresa"         value="<?php echo  $_SESSION["codigoEntidad"]; ?>">
		<input type='hidden' name='nit'					value="<?php echo  $_SESSION["nit"]; ?>" />
		<input type='hidden' name='razonSocial'			value="<?php echo  $_SESSION["razonSocial"]; ?>">
		<input type='hidden' name='serviceCode'			value="<?php echo  $_SESSION["codigoServicio"]; ?>"/>
		<input type="hidden" name="url"					value="<?php echo  $_SESSION["url"]; ?>">
		<input type='hidden' name='paymentDescription'  value="<?php echo $_SESSION["concepto"]; ?>">
		<input type="hidden" name="reference" 		   	value="<?php echo $_SESSION["referencia"]; ?>" />
		<input type='hidden' name='reference1' 		   	value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
		<input type='hidden' name='reference2' 		   	value="<?php echo  $_SESSION["tipo_documento"]; ?>" />
		<input type='hidden' name='reference3' 		   	value="<?php echo $_SESSION["identificacion"]; ?>" />
		<input type='hidden' name='url_retorno' 	   	value="<?php echo  $_SESSION["url"]; ?>">
		<input type='hidden' name='ficha' 			  	value="<?php echo $_SESSION["ficha"]; ?>" />
		<input type="hidden" name="procesar"   			value=""  id="procesar" >
	
		<input type="hidden" name="id_transaccion"      value="<?php echo $_SERVER['REMOTE_ADDR']; ?>"/>




	<?php
	/*
echo "1".$_SESSION["ticket"]."<br>";
echo "2".$_SESSION["referencia"]."<br>";
echo "3".$_SESSION["total"]."<br>";
echo "4".$_SESSION["iva"]."<br>";
echo "5".$_SESSION["concepto"]."<br>";
echo "6".$_SESSION["identificacion"]."<br>";
echo "7".$_SESSION["nombre"]."<br>";
echo "8".$_SESSION["empresa"]."<br>";
echo "9".$_SESSION["consecutivo"]."<br>";
die ("10".$_SESSION["tipo_doc"]."<br>");
*/?>
</form>


</body>
</html>
