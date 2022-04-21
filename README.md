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

## Korzystanie z API

### Autoryzacja

W celu nawiązania połączenia z API należy podać dane autoryzacyjne.

```php
$credentials = new AlleKurier\WygodneZwroty\Api\Credentials('KOD_KLIENTA', 'TOKEN_AUTORYZACYJNY');
$api = new AlleKurier\WygodneZwroty\Api\Client($credentials);
```

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `TOKEN_AUTORYZACYJNY`: Token autoryzacyjny.

Jeżeli zamiast PHP używany ma być inny język należy wysyłać w nagłówku HTTP element `Authorization` typu `Basic` przekazując token autoryzacyjny w formacie BASE64, np.:

```
Authorization: Basic MTIzNA==
```

### Zwracane dane

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

### Komendy

#### Pobranie danych przesyłki

##### Zapytanie

https://api.allekurier.pl/v1/KOD_KLIENTA/order/trackingnumber/NUMER_SLEDZENIA

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `NUMER_SLEDZENIA`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

##### Odpowiedź

W kluczu `data` znajdują się następujące elementy:

<span id="order-details"></span>
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
    * `additional_fields`: Dodatkowe pola informacyjne podane przez klienta podczas zlecania zwrotu - format JSON. W danych znajduje się tablica obiektów, z których każdy zawiera następujące elementy:
        * `name`: Nazwa dodatkowego pola - w danych na pewno znajduje się pole o nazwie `orderNumber`, które zawiera numer zamówienia, którego dotyczy zwrot.
        * `title`: Tytuł dodatkowego pola, który pojawiał się klientowi podczas składania zlecenia na zwrot.
        * `value`: Wartość dodatkowego pola. Zawiera m.in. pole "orderNumber" z numerem zamówienia, którego dotyczy przesyłka. W przypadku braku danych zwracana jest wartość NULL.

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
            "additional_fields":[
                {
                    "name":"orderNumber",
                    "title":"Numer zam\u00f3wienia",
                    "value":"12345678"
                },
                {
                    "name":"returnCase",
                    "title":"Pow\u00f3d zwrotu",
                    "value":"Inny pow\u00f3d"
                }
            ]
        }
    }
}
```

##### Przykłady

###### PHP

```php
$request = new AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberRequest(
    'NUMER_SLEDZENIA'
);

/** @var \AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber\GetOrderByTrackingNumberResponse|\AlleKurier\WygodneZwroty\Api\Lib\Errors\ErrorsInterface $response */
$response = $api->call($request);

if ($response->hasErrors()) {
    foreach ($response->getErrors() as $error) {
        echo $error->getMessage() . PHP_EOL;
        echo $error->getCode() . PHP_EOL;
        echo $error->getLevel() . PHP_EOL;
    }
} else {
    echo $response->getOrder()->getNumber() . PHP_EOL;
    echo $response->getOrder()->getHid() . PHP_EOL;
    echo $response->getOrder()->getUser()->getEmail() . PHP_EOL;
    echo $response->getOrder()->getSender()->getName() . PHP_EOL;
    echo $response->getOrder()->getSender()->getCompany() . PHP_EOL;
    echo $response->getOrder()->getSender()->getAddress() . PHP_EOL;
    echo $response->getOrder()->getSender()->getPostalCode() . PHP_EOL;
    echo $response->getOrder()->getSender()->getCity() . PHP_EOL;
    echo $response->getOrder()->getSender()->getCountry()->getCode() . PHP_EOL;
    echo $response->getOrder()->getSender()->getCountry()->getName() . PHP_EOL;
    echo $response->getOrder()->getSender()->getState() . PHP_EOL;
    echo $response->getOrder()->getSender()->getPhone() . PHP_EOL;
    echo $response->getOrder()->getSender()->getEmail() . PHP_EOL;
    if (!empty($response->getOrder()->getSender()->getAccessPoint())) {
        echo $response->getOrder()->getSender()->getAccessPoint()->getCode() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getName() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getAddress() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getPostalCode() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getCity() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getDescription() . PHP_EOL;
        echo $response->getOrder()->getSender()->getAccessPoint()->getOpenHours() . PHP_EOL;
    }
    foreach ($response->getOrder()->getAdditionalFields()->getAll() as $additionalField) {
        echo
            '"' . $additionalField->getName() . '";' .
            '"' . $additionalField->getTitle() . '";' .
            '"' . $additionalField->getValue() . '";' .
            PHP_EOL;
    }
}
```

gdzie:

* `NUMER_SLEDZENIA`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

###### cURL

```bash
curl -X GET \
  https://api.allekurier.pl/v1/KOD_KLIENTA/order/trackingnumber/NUMER_SLEDZENIA \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'authorization: TOKEN_AUTORYZACYJNY'
```

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `TOKEN_AUTORYZACYJNY`: Token autoryzacyjny.
* `NUMER_SLEDZENIA`: Numer śledzenia przesyłki lub numer, który został zeskanowany na liście przewozowym.

#### Pobranie przesyłek wysłanych w danym dniu

##### Zapytanie

https://api.allekurier.pl/v1/KOD_KLIENTA/order/sent?date=DATA

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `DATA`: Data w formacie Y-m-d wg, której pobierana jest lista przesyłek. Gdy null- dzisiejsza data.

##### Odpowiedź

W kluczu `data` znajdują się następujące elementy:

* `orders`: Zwrócone przesyłki.
  * `order`: Szczegóły przesyłki [zobacz](#order-details)

Przykład:

```json
{
    "failure":false,
    "successful":true,
    "data":{
        "orders":[
            {
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
                "additional_fields":[
                    {
                        "name":"orderNumber",
                        "title":"Numer zam\u00f3wienia",
                        "value":"12345678"
                    },
                    {
                        "name":"returnCase",
                        "title":"Pow\u00f3d zwrotu",
                        "value":"Inny pow\u00f3d"
                    }
                ]
            },
            {
                "hid":"121891fe-f7eb-4b03-896f-3a94cae165ba",
                "user":{
                    "email":"test@allekurier.pl"
                },
                "sender":{
                    "name":"name",
                    "company":"company 2",
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
                "additional_fields":[
                    {
                        "name":"orderNumber",
                        "title":"Numer zam\u00f3wienia",
                        "value":"123456789"
                    },
                    {
                        "name":"returnCase",
                        "title":"Pow\u00f3d zwrotu",
                        "value":"Inny pow\u00f3d"
                    }
                ]
            }
        ]
    }
}
```

##### Przykłady

###### PHP

```php
$request = new AlleKurier\WygodneZwroty\Api\Command\GetSentOrders\GetSentOrdersRequest(
    'DATA'
);

/** @var \AlleKurier\WygodneZwroty\Api\Command\GetSentOrders\GetSentOrdersResponse|\AlleKurier\WygodneZwroty\Api\Lib\Errors\ErrorsInterface $response */
$response = $api->call($request);

if ($response->hasErrors()) {
    foreach ($response->getErrors() as $error) {
        echo $error->getMessage() . PHP_EOL;
        echo $error->getCode() . PHP_EOL;
        echo $error->getLevel() . PHP_EOL;
    }
} else {
    foreach ($response->getOrders() as $order) {
        echo $order->getNumber() . PHP_EOL;
        echo $order->getHid() . PHP_EOL;
        echo $order->getUser()->getEmail() . PHP_EOL;
        echo $order->getSender()->getName() . PHP_EOL;
        echo $order->getSender()->getCompany() . PHP_EOL;
        echo $order->getSender()->getAddress() . PHP_EOL;
        echo $order->getSender()->getPostalCode() . PHP_EOL;
        echo $order->getSender()->getCity() . PHP_EOL;
        echo $order->getSender()->getCountry()->getCode() . PHP_EOL;
        echo $order->getSender()->getCountry()->getName() . PHP_EOL;
        echo $order->getSender()->getState() . PHP_EOL;
        echo $order->getSender()->getPhone() . PHP_EOL;
        echo $order->getSender()->getEmail() . PHP_EOL;
        if (!empty($order->getSender()->getAccessPoint())) {
            echo $order->getSender()->getAccessPoint()->getCode() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getName() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getAddress() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getPostalCode() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getCity() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getDescription() . PHP_EOL;
            echo $order->getSender()->getAccessPoint()->getOpenHours() . PHP_EOL;
        }
        foreach ($order->getAdditionalFields()->getAll() as $additionalField) {
            echo
                '"' . $additionalField->getName() . '";' .
                '"' . $additionalField->getTitle() . '";' .
                '"' . $additionalField->getValue() . '";' .
                PHP_EOL;
        }
    }
}
```

gdzie:

* `DATA`: Data w formacie Y-m-d wg, której pobierana jest lista przesyłek. Gdy null- dzisiejsza data.

###### cURL

```bash
curl -X GET \
  https://api.allekurier.pl/v1/KOD_KLIENTA/order/sent?date=DATA \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'authorization: TOKEN_AUTORYZACYJNY'
```

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `TOKEN_AUTORYZACYJNY`: Token autoryzacyjny.
* `DATA`: Data w formacie Y-m-d wg, której pobierana jest lista przesyłek. Gdy null- dzisiejsza data.

#### Utworzenie przesyłki zwrotnej

##### Zapytanie

POST https://api.allekurier.pl/v1/KOD_KLIENTA/return-order

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.

Pola post:
* `service_code`: [kod usługi](#kody-usług)
* `sender`: dane nadawcy
  * `name`: imię i nazwisko
  * `company`: nazwa firmy
  * `address`: adres
  * `postal_code`: kod pocztowy
  * `city`: miasto
  * `coutry`: kod kraju w formacie ISO 3166
  * `phone`: telefon
  * `email`: email
  * `shipment_type`: typ przesyłki. Dostępne opcje: 
    * "door"- do odbioru przez kuriera
    * "point"- nadawca zanosi do punktu
* `packages`: tablica paczek w przesyłce
  * `weight`: waga paczki [kg]
  * `length`: długość paczki [cm]
  * `width`: szerokość paczki [cm]
  * `height`: wysokość paczki [cm]
  * `custom`: true = przesyłka niestandardowa https://allekurier.pl/pakowanie-przesylek/niestandardowa
* `additional_fields`: tablica pól dodatkowych (dostępne pola są ustalane indywidualnie dla właściciela sklepu). Domyślnie jest wymagane pole `name` = "orderNumber"
  * `name`: nazwa pola
  * `value`: wartość

##### Odpowiedź

W kluczu `data` znajdują się następujące elementy:

* `order_hid`: Identyfikator przesyłki w formacie UUID.

Przykład:

```json
{
    "failure":false,
    "successful":true,
    "data":{
        "order_hid":"53efe1c9-34ab-43d5-bb40-798e81368b46"
    }
}
```

##### Przykłady

###### PHP

```php
$request = new AlleKurier\WygodneZwroty\Api\Command\CreateOrder\CreateOrderRequest(
    new AlleKurier\WygodneZwroty\Api\Model\Request\Order(
        ServiceCode::INPOST_PACZKOMAT,
        new AlleKurier\WygodneZwroty\Api\Model\Request\Sender(
            'Sender name',
            'Sender company name',
            'Address 1',
            '30-147',
            'Kraków',
            'PL',
            '123123123',
            'test@allekurier.pl',
            ShipmentType::door
        ),
        [
            new AlleKurier\WygodneZwroty\Api\Model\Request\Package(2.5, 5, 10, 15, false)
        ],
        [
            new AlleKurier\WygodneZwroty\Api\Model\Request\AdditionalField(
                'orderNumber',
                '357777',
            ),
            new AlleKurier\WygodneZwroty\Api\Model\Request\AdditionalField(
                'returnCase',
                'Produkt mi nie odpowiada',
            ),
        ],
    )
);

/** @var \AlleKurier\WygodneZwroty\Api\Command\CreateOrder\CreateOrderResponse|\AlleKurier\WygodneZwroty\Api\Lib\Errors\ErrorsInterface $response */
$response = $api->call($request);

if ($response->hasErrors()) {
    foreach ($response->getErrors() as $error) {
        echo $error->getMessage() . PHP_EOL;
        echo $error->getCode() . PHP_EOL;
        echo $error->getLevel() . PHP_EOL;
    }
} else {
    echo $response->getOrderHid() . PHP_EOL;
}
```

###### cURL

```bash
curl -X POST \
https://api.allekurier.pl/v1/12345/return-order \
-H 'accept: application/json' \
-H 'cache-control: no-cache' \
-H 'content-type: application/json' \
-H 'authorization: TOKEN_AUTORYZACYJNY' \
-d '{
"service_code":"inpostreturn",
"sender":{
    "name":"Sender name",
    "company":"Sender company name",
    "address":"Address 1",
    "postal_code":"30-147",
    "city":"Kraków",
    "country":"PL",
    "phone":"123123123",
    "email":"test@allekurier.pl",
    "shipment_type":"point"
},
"packages":[
    {
        "weight":"2.5",
        "length":"5",
        "width":"10",
        "height":"12.5",
        "custom":false
    }
],
"additional_fields":[
    {
        "name":"orderNumber",
        "value":"357777"
    },
    {
        "name":"returnCase",
        "value":"Produkt mi nie odpowiada"
    }
]
}'
```

gdzie:

* `KOD_KLIENTA`: Kod autoryzacyjny klienta.
* `TOKEN_AUTORYZACYJNY`: Token autoryzacyjny.

### Słownik

#### Kody usług

| Nazwa usługi     | Kod                |
|------------------|--------------------|
| DHL bez etykiety | dhlreturn          |
| DHL z etykietą   | dhlreturnwithlabel |
| Inpost Paczkomat | inpostreturn       |
| GLS Poland       | glspolandreturn    |