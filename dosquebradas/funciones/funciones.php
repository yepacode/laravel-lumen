<?php

#############################################################################3

function setTransaccion($codigo_entidad, $referencia, $tipo_documento, $no_documento, $nombre, $valor, $iva, $descripcion, $serviceCode)
{
    $sql = "insert into tbl_recaudo (codigo_empresa, referencia, tipo_documento, no_documento, nombre, valor, iva , descripcion, serviceCode)
		values ('$codigo_entidad', '$referencia', '$tipo_documento', '$no_documento', '$nombre', '$valor', '$iva', '$descripcion', '$serviceCode')";

    //echo $sql;
    $query = pg_query(utf8_encode($sql));
    if ($query) {
        return pg_fetch_assoc($query);
    }
    return false;
}

##################################################################################

function updatePagos($id_registro)
{
    $sql = "update tbl_recaudo set estado='2', fecha_pago=now() where referencia='$id_registro' ";
    $query = pg_query($sql);
}

##############################################################################

function referenciaPagada($rerferencia)
{
    $sql = "select * from tbl_recaudo where referencia='$rerferencia' and estado='2'";
    $query = pg_query($sql);
    if ($query && $array = pg_fetch_assoc($query)) {
        return true;
    }
    return false;
}

##################################################################

function updateEstadoTransaccion($referencia, $estado, $cus)
{
    // $sql="update tbl_predial set estado='$estado', cus='$cus' where referencia='$referencia'  ";
    // echo $sql;
    //$query = pg_query($sql);
}

/*
 * @Pago Tarjeta de CrÃƒÂ©dito
 */
######################################################################

function getCompania($nit)
{
    $sql = "SELECT * FROM tbl_companias where nit = '$nit';";
    $query = pg_query($sql);
    if ($row = pg_fetch_assoc($query)) {
        return $row;
    } else {
        return NULL;
    }
}

######################################################################

function getCompaniaCodigo($codigo)
{
    $sql = "SELECT * FROM tbl_companias where codigo = '$codigo';";
    $query = pg_query($sql);
    if ($row = pg_fetch_assoc($query)) {
        return $row;
    } else {
        return NULL;
    }
}

######################################################################

function getReferenciaPSE($id)
{
    if ($id != '') {
        $sql = "SELECT referencia_pse FROM tbl_transacciones WHERE no_documento='$id' and (referencia_pse is not null and referencia_pse<>'') ORDER BY referencia_pse DESC";
        //echo sql;
        $query = pg_query($sql);
        if ($query && $array = pg_fetch_assoc($query)) {
            $consecutivo = substr($array["referencia_pse"], -3);
            $consecutivo++;
            //echo $consecutivo."<br>";
            $referencia = date("Y") . getCompletarCeros(11, $id) . getCompletarCeros(3, $consecutivo);
        } else {
            $referencia = date("Y") . getCompletarCeros(11, $id) . getCompletarCeros(3, 1);
        }
        //echo $referencia;
        return $referencia;
    }
}

######################################################################

function getCompletarCeros($longitud, $valor)
{
    $tam_final = $longitud - strlen($valor);
    //echo "Long:".$longitud."Valor:".strlen($valor)."=".$tam_final;
    $ceros = "";
    for ($i = 1; $i <= $tam_final; $i++) {
        $ceros .= "0";
    }
    //echo $ceros.$valor;
    return $ceros . $valor;
}

######################################################################

function pagoEnProceso($ref_pse)
{
    pg_close();
    include("conexion_pse.php");
    $sql = "select * from tbl_transacciones where fecha_inicio > current_timestamp - INTERVAL '15' day and cod_empresa='0117' and referencia='$ref_pse' and estado='PENDING'";
    //echo $sql;
    $q = pg_query($sql);
    if ($q) {
        $datos = pg_fetch_assoc($q);
    }
    pg_close();
    include("conexion.php");
    return $datos;
}

#################################################################
####### VALIDAR USUARIO LOGIN #################################

function validarUsuarioAdmim($user, $clave)
{
    $usuario = 0;
    $sql = "SELECT * FROM tbl_usuarios WHERE id_usuario ='$user'";
    //	echo $sql;
    $query = pg_query($sql);
    if ($query && $array = pg_fetch_assoc($query)) {
        if ($array["clave"] == $clave) {
            //	echo $array["clave"]."-";
            return $array;
        }
    } else {
        return $usuario;
    }
}

#####################################################################

function getDatosUsuarioId($id)
{
    $sql = "SELECT * FROM tbl_usuarios WHERE id_usuario='$id'";
    //echo "CONSULTA getDatosCliente XXXXX".$sql;
    $query = pg_query($sql);
    if ($query && $array = pg_fetch_assoc($query)) {
        return $array;
    } else {
        return false;
    }
}

#######################################################################

function cambiarClaveAdmin($nueva_clave, $id)
{
    $sql = "update tbl_usuarios set clave='$nueva_clave' where id_usuario='$id'";
    $query = pg_query($sql);
    if (pg_affected_rows($query)) {
        return true;
    }
    return false;
}

#####################################################################
#
#######################################################################
#####################   ASOBANCARIA    ###############################
######################################################################
########################### SQL ######################################

/* ------------------ FUNCIONES GENERALES ------------------ */

function getSQL($sql, $varios = false)
{

    $query = pg_query($sql);
    if ($varios == true) {
        if ($query) {
            while ($array = pg_fetch_assoc($query)) {
                $datos[] = $array;
            }
        } else {
        }
    } else {
        if ($query) {
            $datos = pg_fetch_assoc($query);
        } else {
        }
    }
    return $datos;
}

/* --------------------------------------------------------- */

function updateSQL($sql)
{

    $query = pg_query($sql);
    if ($query) {
        if (pg_affected_rows($query) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

/* //////////////// FIN FUNCIONES GENERALES //////////////// */

########################### ASOBANCARIA ############################

/* ---------------  CONCECUTIVOS ASOBANCARIA --------------- */

function getTotalDescargasConsolidados()
{
    $sql = "update ref_control_asobancaria set total_descargas = total_descargas + 1";
    updateSQL($sql);
    $sql = "select sum(total_descargas) total from ref_control_asobancaria";
    $array = getSQL($sql, false);
    return $array["total"];
}

###################################################################

function getDescargaConsolidados()
{
    $sql = "SELECT fecha_descarga FROM ref_control_asobancaria LIMIT 1";
    $fecha = getSQL($sql, false);
    $fecha = $fecha["fecha_descarga"];
    $hoy = date("Y-m-d");

    if ($fecha == $hoy) {
        $sql = "UPDATE ref_control_asobancaria SET descargas_dia= descargas_dia+1";
    } else {
        $sql = "UPDATE ref_control_asobancaria SET descargas_dia= 0, fecha_descarga = now()";
        updateSQL($sql);
        $sql = "UPDATE ref_control_asobancaria SET descargas_dia= 65, fecha_descarga = now()";
    }

    $update = updateSQL($sql);
    $sql = "SELECT SUM(descargas_dia) as total FROM ref_control_asobancaria";
    $array = getSQL($sql, false);

    if ($array["total"] == 91) {
        $sql = "UPDATE ref_control_asobancaria SET descargas_dia= 0, fecha_descarga = now()";
        updateSQL($sql);
        $sql = "SELECT SUM(descargas_dia) as total FROM ref_control_asobancaria";
        $array = getSQL($sql, false);
    }

    if ($array["total"] >= 65 && $array["total"] <= 90) {
        return chr($array["total"]);
    } else {
        return $array["total"];
    }
}

/* ////////////// FIN CONCECUTIVOS ASOBANCARIA ////////////// */

function getArchivoConsolidado($fecha)
{
    $fecha_inicio = fechaConsolidado($fecha);
    $sql = "select referencia, valor, fecha_fin, cod_empresa, estado, ciclo, 'PSE' as franquicia
        from v_transacciones
        where (fecha_fin BETWEEN CAST('$fecha_inicio 17:00:00' AS TIMESTAMP) - CAST('1 days' AS INTERVAL) and CAST('$fecha 14:00:00' AS TIMESTAMP) and ciclo < 4
              or
              fecha_fin BETWEEN CAST('$fecha 09:00:01' AS TIMESTAMP) and CAST('$fecha 20:00:00' AS TIMESTAMP) and ciclo > 1)
        Union
        select referencia_visa as referencia, valor_visa as valor, fecha_fin, cod_empresa, estado, '1' as ciclo, franquicia
        from v_transacciones_visa
        where fecha_fin between '$fecha_inicio 00:00:00' and '$fecha 23:59:59' ";
    //echo $sql;

    if ($query = pg_query($sql)) {
        while ($array = pg_fetch_assoc($query)) {
            $datos[] = $array;
        }
        return $datos;
    }
    return 0;
}

############################################################################

/* -----------------  CALENDARIO LABORAL  ------------------ */

/*
 * Calcula dias consolidado segun calendario laboral
 */

function fechaConsolidado($fecha)
{
    pg_close();
    include("conexion_pse.php");

    while (festivoAnterior($fecha) == 1) {
        $fecha = fechaMenosDia($fecha);
    }
    pg_close();
    include("conexion.php");
    return $fecha;
}

function festivoAnterior($fecha)
{

    $dias = 1;
    $fecha = date("Y-m-d", strtotime("$fecha -$dias day"));
    $sql = "select * from ref_calendario_laboral where fecha = '$fecha'";
    $fecha = getSQL($sql, false);
    return $fecha["festivo"];
}

function fechaMenosDia($fecha)
{

    $dias = 1;
    $fecha = date("Y-m-d", strtotime("$fecha -$dias day"));
    return $fecha;
}

############################################################################

function getSumaConsolidado($fecha)
{
    $fecha_inicio = fechaConsolidado($fecha);
    $sql = "select sum(valor) as valor
            from (select sum(valor) as valor
        from v_transacciones
        where (fecha_fin BETWEEN CAST('$fecha_inicio 17:00:00' AS TIMESTAMP) - CAST('1 days' AS INTERVAL) and CAST('$fecha 14:00:00' AS TIMESTAMP) and ciclo < 4
                or
                fecha_fin BETWEEN CAST('$fecha 09:00:01' AS TIMESTAMP) and CAST('$fecha 20:00:00' AS TIMESTAMP) and ciclo > 1)
        Union
        select sum(valor_visa) as valor
        from v_transacciones_visa
        where fecha_fin between '$fecha_inicio 00:00:00' and '$fecha 23:59:59') as t";
    //echo $sql;
    if ($query = pg_query($sql)) {
        while ($array = pg_fetch_assoc($query)) {
            $datos[] = $array;
        }
        return $datos;
    }
    return 0;
}

##########################################################################################

/* --------------------  CODIGO BANCO  --------------------- */

/*
 * Trae codigo del banco segun tabla ref_bancos
 */

function getNombreBanco($referencia)
{

    try {
        pg_close();
        include("conexion_pse.php");
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
    $sql = "select banco from tbl_transacciones where referencia = '$referencia' and estado = 'OK';";
    $query = pg_query($sql);

    if ($array = pg_fetch_assoc($query)) {
        $nombre_banco = $array["banco"];
    } else {
        $nombre_banco = "";
    }
    $sql = "select cod_banco from ref_bancos where banco = '$nombre_banco'";
    pg_close();
    include("conexion.php");
    return $sql;
}

function getCodigtransito($sql)
{
    //echo $sql;
    $query = pg_query($sql);
    if ($query) {
        $codigoBanco = pg_fetch_assoc($query);
    }
    pg_close();
    include("conexion.php");
    return $codigoBanco["cod_banco"];
}

/* -------------------  FIN CODIGO BANCO  ------------------- */
##########################################################################################

function update_recaudo($referencia, $identificacion, $tipo_id, $nombre)
{

    $sql = "select id_recibo from tbl_recaudo where num_factura = '$referencia' order by id_recibo DESC limit 1";
    $query = pg_query($sql);
    if ($query) {
        $resul = pg_fetch_assoc($query);
        $id_recibo = $resul["id_recibo"];
    }
    if ($id_recibo) {
        $sql = "UPDATE tbl_recaudo  SET identificacion = '$identificacion', tipo_id = '$tipo_id', nombres = '$nombre' WHERE  id_recibo = '$id_recibo';";

        if ($query = pg_query($sql))
            return true;
        else
            return false;
    }
}

##########################################################################################

function insert_recaudo($referencia, $total, $numfactura, $identificacion, $tipo_id, $nombre, $tipo_renta, $concepto)
{

    $sql = "INSERT INTO tbl_recaudo (num_factura, valor_total, fac_consultada, identificacion, tipo_id, nombres, tipo_renta, renta) values ('$referencia', '$total', '$numfactura', '$identificacion', '$tipo_id', '$nombre', '$tipo_renta','$concepto');";
    $query = pg_query($sql);
    return $query;
}

##########################################################################################

function validarPago($referencia)
{

    $sql = "select * from tbl_recaudo where num_factura='$referencia' and estado='2';";
    $query = pg_query($sql);

    if (count($query) > 0) {
        return true;
    }

    return false;
}

##########################################################################################

function getPago($cus)
{

    $sql = "select * from tbl_recaudo where cus='$cus' order by id_recibo desc limit 1;";
    $query = pg_query($sql);

    if ($query && $array = pg_fetch_assoc($query)) {
        return $array;
    }

    return false;
}

##########################################################################################

function getPagoPse($cus)
{

    pg_close();
    include("conexion_pse.php");
    $sql = "select * from tbl_transacciones where cus='$cus';";
    $query = pg_query($sql);
    pg_close();
    include("conexion.php");

    if ($query && $array = pg_fetch_assoc($query)) {
        return $array;
    }
    return false;
}

#############################################################################
function getFicha($valor, $referencia) {

    $semilla = hash("md5", "realtech" . date("Ymd"));

    $data = $valor . $referencia . $semilla;
    $var2 = hash("sha256", $data);
    return $var2;
}

#############################################################################
function getFicha2($valor, $referencia)
{
    $data = $valor . $referencia . hash("sha256", "R3*t5-4N.Gtx9!D" . date("Ymd"));

    $var2 = hash("sha512", $data);
    return $var2;
}

function getUserIpAddress() {
    $array = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($array as $key) {
        // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER
        if (array_key_exists($key, $_SERVER)) {
            // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                return $ip;
            }
        }
    }
    return '?'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
}