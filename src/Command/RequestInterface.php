<?php
/*
 * RequestInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace AlleKurier\WygodneZwroty\Api\Command;

use AlleKurier\WygodneZwroty\Api\Lib\Core\Http\MethodEnum;

interface RequestInterface
{
    /**
     * Pobranie metody HTTP dla komendy API
     *
     * @return MethodEnum
     */
    public function getHttpMethod(): MethodEnum;

    /**
     * Pobranie adresu API dla komendy API
     *
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * Pobranie danych zapytania dla komendy API
     *
     * @return array
     */
    public function getRequestData(): array;

    /**
     * Pobranie parametrów zapytania dla komendy API
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * Pobranie przetworzonej poprawnej odpowiedzi
     *
     * @param array $responseHeaders
     * @param array $responseData
     * @return ResponseInterface
     */
    public function getParsedResponse(
        array $responseHeaders,
        array $responseData
    ): ResponseInterface;
}
