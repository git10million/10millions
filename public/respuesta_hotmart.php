<?php

//REGISTRAMOS AL CLIENTE
//EMAIL
//REGISTRAR EL PRODUCTO AL CLIENTE.
//LE ENVIAMOS POR CORREO ELECTRONICO LOS ACCESOS.
//LA URL DE ACCESO


header('Access-Control-Allow-Origin: *');  

ini_set('allow_url_fopen',1);

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


$token_docttus_hotmart="7D5aOggNmm5n6JrVBEbnGJU7xsUSgA16306635";

$hottok_POST=$_POST["hottok"];


$mysqli = new mysqli('localhost', 'root', 'XwQrawoRTvsGZMq', 'docttus_prod');

$sql="INSERT INTO log_hotmart set FechaHotmart=now(), LogHotmart='{$hottok_POST}'";
$mysqli->query($sql);

echo("ok");

?>