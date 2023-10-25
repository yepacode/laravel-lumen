<?php session_start();

include('./funciones/conexion.php');
include('./funciones/funciones.php');

$tipo_documento          = $_POST["tipo_documento"];
$referencia              = $_POST['referencia'];
$identificacion          = $_POST["identificacion"];
$tipo_documento          = $_POST["tipo_documento"];
$nombre                  = $_POST['nombre'];
$valor                   = $_POST['valor'];
$concepto                = $_POST["concepto"];
$codigo_entidad          = $_POST["codigo_entidad"];
$iva                     = 0;
$ip                      = getUserIpAddress();




if (isset($_POST['valor'])) {
    $valor = $_POST['valor'];
} else {
    $valor = 0;
}

$codigo_servicio = $_POST["codigo_servicio"];
$codigo_entidad = $_POST["codigo_entidad"];
$iva = $_POST["iva"];
if ($referencia) {

	if (referenciaPagada($referencia)) {
		$cus = pagoEnProceso($referencia);
?>
		<link href="css/estilos.css" rel="stylesheet" type="text/css">
		<table align="center" border="0" cellpadding="0" cellspacing="3" class="tablaPrincipal" height="300" width="500">
			<tr>
				<td align="center" colspan="2" style="height: 199px">PAGO SEGURO</td>
			</tr>
			<tr>
				<td colspan="2" height="20" valign="top">En este momento su <?php echo $referencia ?>
					ha finalizado su proceso de pago y cuya transacci&oacute;n se encuentra
					APROBADA en su entidad finaciera. Si desea mayor informacion sobre el estado
					de su operaci&oacute;n puede comunicase a nuestra l&iacute;nea de atenci&oacute;n
					al cliente 57-1-3904070 o enviar un correo electr&oacute;nico a soporte@realtechltda.com
					y preguntar por el estado de la transacci&oacute;n: <?php  $cus["cus"] ?>
				</td>
			</tr>
		</table>
		<?php 
	} else {

		if (pagoEnProceso($referencia)) {
			$cus = pagoEnProceso($referencia);
		?>
			<table align="center" border="0" cellpadding="0" cellspacing="3" class="tablaPrincipal" height="300" width="500">
				<tr>
					<td align="center" colspan="2">PAGO EN LINEA</td>
				</tr>
				<tr>
					<td align="center" colspan="2" height="20" valign="top">En este momento
						la referencia <?php  $referencia ?>presenta un proceso de pago cuya transacci&oacute;n
						se encuentra PENDIENTE de recibir confirmaci&oacute;n por parte de su entidad
						financiera, por favor espere unos minutos y vuelva a consultar mas tarde
						para verificar si su pago fue confirmado de forma exitosa. Si desea mayor
						informaci&oacute;n sobre el estado actual de su operaci&oacute;n puede comunicarse
						a nuestras l&iacute;neas de atenci&oacute;n al cliente al tel&eacute;fono
						57-1-3904070 o enviar sus inquietudes al correo soporte@realtechltda.com
						y pregunte por el estado de la transacci&oacute;n: con el codigo <?php  $cus["cus"] ?>
					</td>
				</tr>
			</table>
		<?php 
		} else {
			setTransaccion($codigo_entidad, $referencia, $tipo_documento, $identificacion, $nombre, $valor, $iva = 0, $concepto, $codigo_servicio);
		?>
			<script>
				function procesa_tarjeta() {
					var form = document.getElementById("form");
					form.action = "https://www.abcpagos.com/credibanco/procesar";
					form.submit();
				}
			</script>
			<table align="center" class="tablaPrincipal" width="450">
				<tr>
					<td align="center" colspan="2">
						<h1>PAGO SEGURO </h1>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="20">&nbsp;</td>
				</tr>
				<tr>
					<td align="left" class="columnaTitulos" width="40%">Referencia de Pago:
					</td>
					<td align="left" class="columnaDesc" width="60%"><b><?php echo  $referencia ?>
						</b></td>
				</tr>
				<tr>
					<td align="left" class="columnaTitulos" nowrap>Nombre o Razon Social :
					</td>
					<td align="left" class="columnaDesc"><?php echo $nombre ?></td>
				</tr>
				<tr>
					<td align="left" class="columnaTitulos">NIT &oacute; C.C:</td>
					<td align="left" class="columnaDesc"><?php echo  $identificacion ?></td>
				</tr>
				<tr>
					<td align="left" class="columnaTitulos">Concepto:</td>
					<td align="left" class="columnaDesc"><?php  echo $concepto; ?></td>
				</tr>
				<tr>
					<td align="left" class="columnaTitulos" style="height: 23px">Total a Pagar
						: </td>
						<td align="left" class="columnaDesc" style="height: 23px"><b><?php echo "$ " . number_format($valor, 0, ',', '.'); ?></b></td>

				</tr>
				<tr>
					<td align="left" class="columnaTitulos">Iva : </td>
					<td align="left" class="columnaDesc"><b><?php echo  "$ " . number_format($iva, '0', ',', '.') ?>
						</b></td>
				</tr>
				<tr>
					<td align="center">
						<img alt="pse" onclick="FAjax('pages/pagoenlinea.php','cuerpo','','POST')" src="./Imagenes/BotonPSE.jpg" style="cursor: pointer">
					</td>
					<td>
						<table>
							<tr>
								<!-- Visa -->
								<input type='hidden' name="complemento_ficha" value="<?php echo getFicha2($valor, $referencia) ?>" />

								<input name="franquicia" type="hidden" value="0">
								<input name="cuenta" type="hidden" value="C">
								<img class="img-fluid align-middle" alt="visa" onclick="form.franquicia.value = '90';procesa_tarjeta()" src="https://www.abcpagos.com/credibanco/resources/images/visa_blanco.jpg" style="cursor: pointer">
								<img class="img-fluid align-middle" alt="master" onclick="form.franquicia.value = '91';procesa_tarjeta()" src="https://www.abcpagos.com/credibanco/resources/images/mastercard.png" style="cursor: pointer">
								<!--<img src="https://www.abcpagos.com/credibanco/resources/images/electron.jpg" style="cursor:pointer" onClick="form.franquicia.value='90';form.cuenta.value='D';procesa_tarjeta()"/>
            					<img src="https://www.abcpagos.com/credibanco/resources/images/amex.jpg" style="cursor:pointer" onClick="form.franquicia.value='30';procesa_tarjeta()"/>
            					<img src="https://www.abcpagos.com/credibanco/resources/images/dinners.jpg"  style="cursor:pointer" onClick="form.franquicia.value='34';procesa_tarjeta()"/>
            					<img src="https://www.abcpagos.com/credibanco/resources/images/credencial.png" style="cursor:pointer" onClick="form.franquicia.value='23';procesa_tarjeta()"/>-->
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
					<td align="center">
						<img class="img-fluid align-middle" alt="credibanco" height="100" src="https://www.abcpagos.com/credibanco/resources/images/Credibanco_version_B_transp.png">
					</td>
				</tr>
			</table>
			<?php 
			?>    <input name="tipoDocumento" type="hidden" value="<?= $tipo_documento; ?>">
			<input name="referencia" type="hidden" value="<?= $referencia; ?>">
			<input name="identificacion" type="hidden" value="<?= $identificacion; ?>">
			<input name="nombre" type="hidden" value="<?= $nombre; ?>">
			<input name="valor" type="hidden" value="<?= $valor; ?>">
			<input name="concepto" type="hidden" value="<?= $concepto; ?>">
			<input name="codigoServicio" type="hidden" value="<?= $codigo_servicio ?>">
			<input name="codigoEntidad" type="hidden" value="<?= $codigo_entidad ?>">
			<input name="iva" type="hidden" value="<?= $iva; ?>"><?php } //end if pagado
																	} //end if en proceso
																			?><a href="#" onclick="window.close();">Cancelar</a> <?php } else { //fin llega referencia
																																	?>
<?php } ?>