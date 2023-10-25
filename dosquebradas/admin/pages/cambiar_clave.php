<?php
session_start();

if ($_SESSION["ses_id"] == "") {
    ?>
    <script>
        window.location = 'index.php';
    </script>
    <?php
}

include_once("../../funciones/conexion.php");
include_once("../../funciones/funciones.php");

$id = $_SESSION['ses_id'];
$datos = getDatosUsuarioId($id);
$reg = $datos["clave"];

if ($_POST["cambiar"]) { //echo "*****";
    if ($reg == $_POST["actual"]) {
        $cb = cambiarClaveAdmin($_POST["nueva"], $id);
        if ($cb) {
            $mensaje = "Se cambio la clave con exito";
        } else {
            $mensaje = "No se pudo cambiar la clave";
        }
    } else {
        $mensaje = "La clave actual no es correcta";
    }
}
?>
<table  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center">&nbsp;</td>
    </tr>    
    <tr>
        <td valign="top">
            <table width="491" border="0" align="center" class="cajaGris">
                <tr>
                    <td  colspan="2" class="barraTitulo">CAMBIAR CONTRASE&Ntilde;A 
                        <input type="hidden" name="cambiar" value="0" />
                    </td>
                </tr>
                <tr>
                    <td width="267"  align="left" class="celda">Contrase&ntilde;a Actual </td>
                    <td width="214" valign="bottom">
                        <label>
                            <span class="celda3">
                                <input type="password" name="actual">
                            </span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td  align="left" class="celda">Nueva Contrase&ntilde;a</td>
                    <td>
                        <span class="celda3">
                            <input type="password" name="nueva">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td  align="left" class="celda">Reescriba la nueva Contrase&ntilde;a</td>
                    <td>
                        <span class="celda3">
                            <input type="password" name="confirmacion">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td  align="center" ><?= $mensaje ?></td>
                    <td height="40" align="right">
                        <input type="button" name="ingresar" value="GUARDAR" onclick="validar_clave_admin(this.form)"  class="btn"/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>