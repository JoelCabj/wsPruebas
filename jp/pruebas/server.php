<?php

$mysqli = new mysqli("localhost", "root", "123", "clientes");

function autenticar(){
    if (isset($_SERVER['PHP_AUTH_USER'])&& isset($_SERVER["PHP_AUTH_PW"])){
        if ($_SERVER['PHP_AUTH_USER'] == "Admin" && $_SERVER["PHP_AUTH_PW"] == "1234"){return true;}
        else{return false;}
    }
}

function buscarDni ($dni){
    if (autenticar()){
    global $mysqli;
    $consulta = $mysqli->prepare("select Nombre, Localidad from clientes where NroDNI = ?");
    $consulta->bind_param("i", $dni);
    $consulta->execute();
    $consulta->bind_result($nombre, $localidad);
    $consulta->fetch();
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $pass = md5($_SERVER["PHP_AUTH_PW"]);
    return "Usuario:$usuario<br>pass:$pass<br>Nombre: $nombre -<br>Localidad: $localidad";
    }
    else{return "Error de Autenticacion";}
}

include './nusoap/lib/nusoap.php';

$server = new soap_server();
$server->configureWSDL("WS de Prueba", "urn:WSP");

$server->register(
        "buscarDni",
        array("dni" => "xsd:int"),
        array("return" => "xsd:string"));

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
