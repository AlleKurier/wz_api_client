<?php
/*
 * HttpInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace Allekurier\WygodneZwroty\Api\Lib\Core\Http;

interface HttpInterface
{
    /**
     * Ustawienie nagłówka HTTP
     *
     * @param string $key
     * @param string $value
     */
    public function setHeader(string $key, string $value): void;

    /**
     * Wyczyszczenie nagłówka HTTP
     *
     * @param string $key
     */
    public function clearHeader(string $key): void;

    /**
     * Pobranie danych z adresu URL
     *
     * @param string $url
     * @param MethodEnum $method
     * @param string $requestData
     * @return HttpResponse
     */
    public function fetch(string $url, MethodEnum $method, string $requestData): HttpResponse;
}
