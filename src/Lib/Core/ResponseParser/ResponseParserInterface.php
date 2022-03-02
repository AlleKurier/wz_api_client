<?php
/*
 * ResponseParserInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace AlleKurier\WygodneZwroty\Api\Lib\Core\ResponseParser;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

interface ResponseParserInterface
{
    /**
     * Pobranie przetworzonej odpowiedzi dla komendy API w oparciu o nagłówki i dane odpowiedzi
     *
     * @param RequestInterface $request
     * @param array $responseHeaders
     * @param array $responseData
     * @return ResponseInterface
     */
    public function getParsedResponse(
        RequestInterface $request,
        array $responseHeaders,
        array $responseData
    ): ResponseInterface;
}
