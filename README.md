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

Zwracane dane są zawsze w formacie JSON. W celu sprawdzenia czy nie wystąpił błąd można sprawdzić jeden z następujących elementów:

* `failure`: Jest ustawione na `true`, gdy zwrócony został błąd.
* `successful`: Jest ustawiony na `true`, gdy błąd nie wystąpił.

Oba elementy są zawsze zwracane w każdej odpowiedzi z API.

Jeżeli nie wystąpił błąd, wszystkie dane zwracane są w elemencie o kluczu `data`.

W przypadku wystąpienia błędu zwracane są następujące elementy:

* `errors`: Tablica błędów.
* `mainError`: Główny błąd.

Każdy z błędów - czy to w tablicy `errors` czy w elemencie `mainError` - zawiera następujące elementy:

* `message`: Opis błędu.
* `code`: Kod błędu. Może zwrócić wartość `null`.
* `level`: Poziom błędu: Dostępne są poziomy: `notice`, `warning`, `critical`.

...

Przykład:

{
    "errors":[
        {
            "message":"Zam\u00f3wienie nie istnieje",
            "code":null,
            "level":"critical"
        }
    ],
    "mainError":{
        "message":"Zam\u00f3wienie nie istnieje",
        "code":null,
        "level":"critical"
    },
    "failure":true,
    "successful":false
}

### Pobranie danych przesyłki

#### Zapytanie

https://new.allekurier.pl/api/v1/kod_klienta/order/trackingnumber/numer_sledzenia

gdzie:

* `kod_klienta`: Kod autoryzacyjny klienta.
* `token_autoryzacyjny`: Token autoryzacyjny.
* `numer_sledzenia`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

#### Odpowiedź

...
!!!!
{
    "failure":false,
    "successful":true,
    "data":{
        "order":{
            "hid":"069439d9-78b5-4992-b2e0-3664491eeac9",
            "user":{
                "email":"test@allekurier.pl"
            },
            "sender":{
                "name":"name",
                "company":"company",
                "address":"address",
                "postal_code":"32-020",
                "city":"Wieliczka",
                "country":{
                    "code":"PL",
                    "name":"Polska"
                },
                "state":null,
                "phone":"123123123",
                "email":"test@allekurier.pl",
                "access_point":null
            },
            "additional_fields":null
        }
    }
}
!!!!
...

#### Przykłady

##### PHP

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

##### cURL

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
