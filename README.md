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

```bash
composer require allekurier/wz-api-client
```

## Użycie biblioteki

W celu nawiązania połączenia z API należy podać dane autoryzacyjne.

```php
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

Każdy z błędów - czy to w tablicy `errors` czy w kluczu `mainError` - zawiera następujące elementy:

* `message`: Opis błędu.
* `code`: Kod błędu. Może zwrócić wartość `null`.
* `level`: Poziom błędu: Dostępne są poziomy: `notice`, `warning`, `critical`.

Przykład:

```json
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
```

### Pobranie danych przesyłki

#### Zapytanie

https://new.allekurier.pl/api/v1/kod_klienta/order/trackingnumber/numer_sledzenia

gdzie:

* `kod_klienta`: Kod autoryzacyjny klienta.
* `token_autoryzacyjny`: Token autoryzacyjny.
* `numer_sledzenia`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

#### Odpowiedź

W kluczu `data` znajdują się następujące elementy:

* `order`: Zwrócone dane dla znalezionej przesyłki.
    * `hid`: Identyfikator przesyłki.
    * `user`: Dane klienta, do którego należy przesyłka.
      * `email`: Adres e-mail klienta.
    * `sender`: Dane nadawcy przesyłki.
      * `name`: Imię i nazwisko nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `company`: Nazwa firmy nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `address`: Adres nadawcy (ulica, budynek i numer lokalu). W przypadku braku danych zwracana jest wartość NULL.
      * `postal_code`: Kod pocztowy nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `city`: Miejscowość nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `country`: Dane kraju nadawcy.
        * `code`: Kod kraju nadawcy.
        * `name`: Nazwa kraju nadawcy.
      * `state`: Stan do adresu nadawcy (tylko dla krajów, które używają nazw stanów). W przypadku braku danych zwracana jest wartość NULL.
      * `phone`: Numer telefonu do nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `email`: Adres e-mail nadawcy. W przypadku braku danych zwracana jest wartość NULL.
      * `access_point`: Dane punktu, z którego nadano przesyłkę. W przypadku braku danych zwracana jest wartość NULL.
        * `code`: Kod punktu.
        * `name`: Nazwa punktu. W przypadku braku danych zwracana jest wartość NULL.
        * `address`: Adres punktu (ulica, budynek i numer lokalu). W przypadku braku danych zwracana jest wartość NULL.
        * `postal_code`: Kod pocztowy punktu. W przypadku braku danych zwracana jest wartość NULL.
        * `city`: Miejscowość punktu. W przypadku braku danych zwracana jest wartość NULL.
        * `description`: Opis punktu. W przypadku braku danych zwracana jest wartość NULL.
        * `open_hours`: Godziny otwarcia punktu. W przypadku braku danych zwracana jest wartość NULL.
      * `additional_fields`: Dodatkowe pola informacyjne podane przez klienta podczas zlecania zwrotu - format JSON. W przypadku braku danych zwracana jest wartość NULL.

Przykład:

```json
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
                "access_point":{
                    "code":"BAN01A",
                    "name":"name",
                    "address":"address",
                    "postal_code":"39-200",
                    "city":"City",
                    "description":"description",
                    "open_hours":""
                }
            },
            "additional_fields":[{"name":"orderNumber","title":"Numer zam\u00f3wienia","value":"12345678"},{"name":"returnCase","title":"Pow\u00f3d zwrotu","value":"Inny pow\u00f3d"},{"name":"bankAccount","title":"Numer konta bankowego do zwrotu \u015brodk\u00f3w","value":"12 3456 7890 1234 5678 9012 3456"},{"name":"bankAccountUsed","title":"Czy podany numer rachunku jest tym samym z kt\u00f3rego zosta\u0142a dokonana p\u0142atno\u015b\u0107 za zam\u00f3wienie?","value":"TAK"}]
        }
    }
}
```

#### Przykłady

##### PHP

```php
$request = new AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberRequest(
    'numer_sledzenia'
);

/** @var \AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberResponse|\AlleKurier\WygodneZwroty\Api\Lib\Core\Errors\ErrorsInterface $response */
$response = $api->call($request);

if ($response->hasErrors()) {
    foreach ($response->getErrors() as $error) {
        echo $error->getMessage().PHP_EOL;
        echo $error->getCode().PHP_EOL;
        echo $error->getLevel().PHP_EOL;
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
