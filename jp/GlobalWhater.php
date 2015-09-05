        <?php
        $url = "http://wsf.cdyne.com/WeatherWS/Weather.asmx?wsdl";
            $cliente = new SoapClient(
                    $url,
                    array(
                        "location" => $url,
                        'uri' => $url,
                        'trace' => 1,
                    ));
            $cliente->__setSoapHeaders()
            $result = $cliente->__call("GetWeather", array("CityName" =>"Cipolletti", "CountryName" => "Argentina"));
            echo $result;
        ?>
>
