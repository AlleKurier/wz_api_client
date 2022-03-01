<?php

include 'vendor/autoload.php';

$credentials = new Allekurier\WygodneZwroty\Api\Credentials('12345', '1234');
$api = new Allekurier\WygodneZwroty\Api\Client($credentials);

$command = new Allekurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberRequest(
    '12345678'
);

/** @var \Allekurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberResponse|\Allekurier\WygodneZwroty\Api\Lib\Core\Errors\ErrorsInterface $response */
$response = $api->call($command);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    echo $response->getOrder()->getHid().PHP_EOL;
    echo $response->getOrder()->getUser()->getEmail().PHP_EOL;
    echo $response->getOrder()->getSender()->getName().PHP_EOL;
    echo $response->getOrder()->getSender()->getCompany().PHP_EOL;
    echo $response->getOrder()->getSender()->getAddress().PHP_EOL;
    echo $response->getOrder()->getSender()->getPostalCode().PHP_EOL;
    echo $response->getOrder()->getSender()->getCity().PHP_EOL;
    echo $response->getOrder()->getSender()->getCountry()->getCode().PHP_EOL;
    echo $response->getOrder()->getSender()->getCountry()->getName().PHP_EOL;
    echo $response->getOrder()->getSender()->getState().PHP_EOL;
    echo $response->getOrder()->getSender()->getPhone().PHP_EOL;
    echo $response->getOrder()->getSender()->getEmail().PHP_EOL;
    if (!empty($response->getOrder()->getSender()->getAccessPoint())) {
        echo $response->getOrder()->getSender()->getAccessPoint()->getCode().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getName().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getAddress().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getPostalCode().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getCity().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getDescription().PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getOpenHours().PHP_EOL;
    }
    var_dump($response->getOrder()->getAdditionalFields()).PHP_EOL;
}
