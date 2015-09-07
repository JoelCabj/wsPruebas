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
        
function AddWSSUsernameToken($client, $username, $password) //Funcion para crear token de autenticacion; Se puede copiar algunas cosas para hacer otros tokens.
    {
        $wssNamespace = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";

        $username = new SoapVar($username, 
                                XSD_STRING, 
                                null, null, 
                                'Username', 
                                $wssNamespace);

        $password = new SoapVar($password, 
                                XSD_STRING, 
                                null, null, 
                                'Password', 
                                $wssNamespace);

        $usernameToken = new SoapVar(array($username, $password), 
                                        SOAP_ENC_OBJECT, 
                                        null, null, 'UsernameToken', 
                                        $wssNamespace);

        $usernameToken = new SoapVar(array($usernameToken), 
                                SOAP_ENC_OBJECT, 
                                null, null, null, 
                                $wssNamespace);

        $wssUsernameTokenHeader = new SoapHeader($wssNamespace, 'Security', $usernameToken);

        $client->__setSoapHeaders($wssUsernameTokenHeader); 
    }

    
    
    
    
            include './nusoap/lib/nusoap.php';
  
            $urlServ = 'http://localhost/wsPruebas/jp/pruebas/server.php?wsdl';
            $headerBody = array(
                    "UsernameToken"=>"Joel",
                    "Password"=>"123456"
            );
           
            $header = new SoapHeader(
                    "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd",
                    "security",
                    $headerBody,
                    false
                    );
           
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
            /*$cliente->__setSoapHeaders($header);*/
            AddWSSUsernameToken($cliente, 'Joel', '123456');
            
           /* $error = $cliente->getError();*/
            /*$cliente->setCredentials("Admin", "1234");*/
            /*if ($error){echo $error;}*/
            $result = $cliente->__call("obtenerHeader", array("dni" => 1));
            echo $result;
            /*echo print_r($header);*/
            
            echo "<br>JSON:<br>".  json_encode($headerBody);
            
        ?>
    </body>
</html>
