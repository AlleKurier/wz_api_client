# Biblioteka kliencka API dla Wygodnych Zwrotów

[![Autor](http://img.shields.io/badge/author-wygodnezwroty.pl-blue.svg?style=flat-square)](https://wygodnezwroty.pl)
[![Licencja](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/AlleKurier/wz_api_client/blob/master/LICENSE.md)

## Wymagania

Biblioteka ma następujące wymagania:

* PHP 7.4 lub nowsza wersja;
* rozszerzenie "ext-curl" do PHP;
* rozszerzenie "ext-json" do PHP.

## Instalacja

W celu zainstalowania biblioteki należy użyć następującego polecenia:

```
composer require allekurier/wz-api-client
```

## Użycie biblioteki

W celu nawiązania połączenia z API należy podać dane autoryzacyjne.

```
$credentials = new AlleKurier\WygodneZwroty\Api\Credentials('kod_klienta', 'token_autoryzacyjny');
$api = new AlleKurier\WygodneZwroty\Api\Client($credentials);
```

gdzie:

* `kod_klienta`: Kod autoryzacyjny klienta.
* `token_autoryzacyjny`: Token autoryzacyjny.

### Pobranie danych przesyłki

#### PHP

```
$request = new AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberRequest(
    'numer_sledzenia'
);

/** @var \AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberResponse|\AlleKurier\WygodneZwroty\Api\Lib\Core\Errors\ErrorsInterface $response */
$response = $api->call($request);

if ($response->hasErrors()) {
    foreach ($response->getErrors() as $error) {
        echo $error->getMessage().PHP_EOL;
        echo $error->getCode().PHP_EOL;
        echo $error->getLevel()->getValue().PHP_EOL;
    }
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

* `numer_sledzenia`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

#### cURL

```bash
curl -X GET \
  https://new.allekurier.pl/api/v1/kod_klienta/order/trackingnumber/numer_sledzenia \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'authorization: token_autoryzacyjny'
```

gdzie:

* `kod_klienta`: Kod autoryzacyjny klienta.
* `token_autoryzacyjny`: Token autoryzacyjny.
* `numer_sledzenia`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.
