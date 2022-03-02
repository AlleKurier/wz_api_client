# Biblioteka kliencka API dla Wygodnych Zwrotów

[![Autor](http://img.shields.io/badge/author-wygodnezwroty.pl-blue.svg?style=flat-square)](https://wygodnezwroty.pl)
[![Licencja](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/kocuj/di/blob/master/LICENSE.md)

## Wymagania

Biblioteka ma następujące wymagania:

* PHP 7.4 lub nowsza wersja;
* rozszerzenie "ext-json" do PHP.

## Instalacja

W celu zainstalowania biblioteki należy użyć następującego polecenia:

```
composer require allekurier/wz-api-client
```

## Użycie biblioteki

```
$credentials = new Allekurier\WygodneZwroty\Api\Credentials('kod_klienta', 'token_autoryzacyjny');
$api = new Allekurier\WygodneZwroty\Api\Client($credentials);
```

# Pobranie danych przesyłki

## PHP

```
$command = new Allekurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberRequest(
    'numer_sledzenia'
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
```

gdzie:

* `numer_sledzenia`: Jest to numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

## cURL

```bash
curl -X GET \
  https://new.allekurier.pl/api/v1/order/trackingnumber/numer_sledzenia \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded'
```

gdzie:

* `numer_sledzenia`: Jest to numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.
