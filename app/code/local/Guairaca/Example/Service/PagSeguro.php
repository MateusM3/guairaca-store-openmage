<?php
class Guairaca_Example_Service_PagSeguro
{
    public function sendOrder()
    {
        $data = [
            "reference_id" => "ex-00002",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 1
                ]
            ],
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => 100
                    ]
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

        $client = new Zend_Http_Client();
        $client->setUri('https://sandbox.api.pagseguro.com/orders');
        $client->setMethod(Zend_Http_Client::POST);

        $client->setHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 2EBFBDB1D5B7447FA0949F9F75CB5476'
        ]);

        $client->setRawData(json_encode($data), 'application/json');
        $response = $client->request();
        Mage::log($response->getRawBody(), null,'guairaca.log');
        return $response;
    }
}