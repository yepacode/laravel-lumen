<?php
session_start();

require_once("../../funciones/conexion.php");
require_once("../../funciones/funciones.php");
$usuario = getDatosUsuarioId($_SESSION["ses_id"]);
?>
<table border="0" cellspacing="0" cellpadding="0" id="menu">
    <tr>
        <td height="45">Usuario:<br><?= $usuario["nombres"] ?></td>
    </tr>   
    <tr>
        <td class="item" onClick="FAjax('pages/asobancaria.php', 'principal', '', 'post')">Generar Asobancaria</td>
    </tr>  
    <tr>
        <td class="item">
            <span  onClick="FAjax('pages/cambiar_clave.php', 'principal', '', 'post')">Cambiar Contrase&ntilde;a</span>
        </td>
    </tr>
    <tr>
        <td class="item">
            <span  onClick="window.location = 'index.php'">Salir</span>
        </td>
    </tr>
    <tr>
        <td height="300" >&nbsp;</td>
    </tr>
</table>