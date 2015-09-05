<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include './nusoap/lib/nusoap.php';
            
            $urlServ = 'http://localhost/wsPruebas/server.php?wsdl';
            $cliente = new SoapClient(
                    $urlServ,
                    array(
                            'location' => $urlServ,
                            'uri' => $urlServ,
                            'trace' => 1,
                            'login' => "Admin",
                            "password" => "1234"
                        )
                    );
            $error = $cliente->getError();
            if ($error){echo $error;}
            $result = $cliente->__call("buscarDni", array(" ‘ or ‘1’=’1"));
            echo $result;
        ?>
    </body>
</html>
