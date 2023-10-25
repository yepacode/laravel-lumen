<?php
session_start();

require_once("../../funciones/conexion.php");
require_once("../../funciones/funciones.php");

if ($_SESSION["ses_id"] == "") {
    ?>
    <script>
        window.location = 'index.php';
    </script>
    <?php
} else {

    if ($_REQUEST["descargar"] == "1" && $_REQUEST["txt_fecha_asobancaria"] != "") {

        $dia = str_replace('/', '', $_REQUEST["txt_fecha_asobancaria"]);
        $fecha = date("ymd");

        header('Content-Description: File Transfer');
        header('Content-type: application/inf');
        header('Content-Disposition: attachment; filename="' . $fecha . '00230109.pro"');
        header("Pragma: no-cache");
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Expires: 0");
        header('Pragma: public');

        $totalDescargas = getTotalDescargasConsolidados();
        $descargasDia = getDescargaConsolidados();
        $consolidados = getArchivoConsolidado($_REQUEST["txt_fecha_asobancaria"]);

        $catidad_registros = count($consolidados);
        $total_recaudo = getSumaConsolidado($_REQUEST["txt_fecha_asobancaria"]);

        $total_recaudado = (int) $total_recaudo['sum'] * 100;
        $fechaRecaudo = substr($_REQUEST["txt_fecha_asobancaria"], 0, 4) . substr($_REQUEST["txt_fecha_asobancaria"], 5, 2) . substr($_REQUEST["txt_fecha_asobancaria"], 8, 2);
        //echo "<br/><br/><br/>".$txt;
        function formato($c, $cant, $pip) {
            printf("%0" . $cant . "s" . $pip, $c);
        }

        function formatoEnBlanco($c, $cant, $pip) {
            printf("% " . $cant . "s" . $pip, $c);
        }

        function formato2($c, $cant, $pip) {
            printf("s" . "%0" . $cant . $pip, $c);
        }

        $txt = formato("01", 2, "") .
                formato("8000993106", 10, "") .
                formato($fechaRecaudo, 8, "") .
                formato("023", 3, "") .
                formato("033488594", 17, "") . //P pendiente por confirmar con el cliente
                formato(date("Ymd"), 8, "") .
                formato(("" . (string) substr(date("H"), -2) . (string) date("i")), 4, "") .
                formato($descargasDia, 1, "") .
                formato("01", 2, "") . //P pendiente por confirmar con el cliente
                formatoEnBlanco(" ", 107, "\r\n") .
                formato("05", 2, "") .
                formato("7709998021044", 13, "") .
                formato($totalDescargas, 4, "") .
                formatoEnBlanco(" ", 143, "\r\n");

        if (count($consolidados) == 0 || $consolidados == NULL) {
            //echo "No hay registros\n";
        } else {
            $i = 0;
            foreach ($consolidados as $consolidado) {
                is_numeric($consolidado["referencia"]) ? $referencia = $consolidado["referencia"] : $referencia = 'NO_REGISTRA';
                $valor = (int) $consolidado["valor"] * 100;
                //$sql = getNombreBanco($consolidado["referencia_pse"]);
               // $codigoBanco = getCodigtransito($sql);
                $txt .= formato("06", 2, "") .
                        formato($referencia, 48, "") .
                        formato($valor, 14, "") .
                        formato("99", 2, "") . //VERIFICAR
                        formato("15", 2, "") . //VERIFICAR
                        formato("0", 6, "") .
                        formato("0", 6, "") . //P
                        formato("023", 3, "") .
                        formato("0", 4, "") . //P
                        formato(($i++) + (2), 7, "") .
                        formatoEnBlanco(" ", 3, "");
                formatoEnBlanco(" ", 65, "\r\n");
            }
        }

        $txt .= formato("08", 2, "") .
                formato($catidad_registros, 9, "") .
                formato($total_recaudado, 18, "") .
                formato($totalDescargas, 4, "") .
                formatoEnBlanco(" ", 129, "\r\n");

        $txt .= formato("09", 2, "") .
                formato($catidad_registros, 9, "") .
                formato($total_recaudado, 18, "") .
                formatoEnBlanco(" ", 133, "\r\n");
    } else {
        ?>
        <br/>
        <table width="430" height="166" border="0" align="center" class="cajaGris">
            <tr>
                <td colspan="2" align="center" class="barraTitulo">ASOBANCARIA</td>
            </tr>
            <tr>
                <td width="101" align="right">Fecha :</td>
                <td width="319">
                    <input type="text" name="txt_fecha_asobancaria" id="txt_fecha_asobancaria" onfocus='Calendar.setup({inputField: "txt_fecha_asobancaria", ifFormat: "%Y-%m-%d", button: "calen"});' readonly="true" />
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="button" name="generar" value="Generar Asobancaria" class="btn" onclick="descargaConsolidado();"/>
                </td>
            </tr>
        </table>
        <?php
    }
}