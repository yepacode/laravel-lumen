<? 
// session_start();

// if (function_exists('curl_init')) { // Comprobamos si hay soporte para cURL
//     $ch = curl_init();
//     $id = trim($_SESSION["cus"]);
//     $medio = $_SESSION["medio"];

// 	curl_setopt($ch, CURLOPT_URL,"http://192.168.2.23:8081/clientewebdosquebradas/notificarpago.jsp?cus=".$id."&tipoPago=".$medio);
// 	curl_setopt($ch, CURLOPT_POST, 2);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, "cus=".$id."&tipoPago=".$medio);
// 	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//     $resultado = trim(curl_exec($ch));

//     //print_r($resultado);
//     //echo "*".trim($resultado)."*";
//     //echo "http://192.168.2.23:8081/clientewebdosquebradas/notificarpago.jsp?cus=".$id."&tipoPago=".$medio;
// }
// else
//     echo "No hay soporte para cURL";
?>