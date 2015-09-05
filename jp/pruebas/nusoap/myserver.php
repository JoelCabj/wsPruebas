<?php
include './lib/nusoap.php';

function sumar ($a){
    return $a + 10;
}

$server = new soap_server();
$server->configureWSDL("Este es mi servidor de Prueba", "urn:MISP");


$server->wsdl->addComplexType(
        "arrayNumeros",
        "complexType",
        "struct",
        "all",
        '',
        array(
            "numero1" => array("name" => "numero1", "type"=>"xsd:integer"),
            "numero2" => array("name" => "numero2", "type"=>"xsd:integer")
            )
        );
/*$server->wsdl->addComplexType("resultado",
        "complexType",
        "struct",
        "all",
        array("resultado" => array("name" => "resultado 1", "type" => "xsd:number")
            )
        );*/

$server->register("sumar",
        array("arrayNumeros" => "xsd:arrayNumeros"),
        array("return" => "xsd:resultado")/*,
       /* "urn:MISP",
        "urn:sumar",
        "rpc",
        "encoded",
        "Recibe dos numeros y los suma"*/
        );

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);