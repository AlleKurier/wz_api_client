<?php
/*
 * HttpResponse.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Lib\Core\Http;

class HttpResponse
{
    private array $responseHeaders;

    private string $responseBody;

    /**
     * Konstruktor
     *
     * @param array $responseHeaders
     * @param string $responseBody
     */
    public function __construct(array $responseHeaders, string $responseBody)
    {
        $this->responseHeaders = array_change_key_case($responseHeaders);
        $this->responseBody = $responseBody;
    }

    /**
     * Pobranie nagłówków odpowiedzi
     *
     * @return array
     */
    public function getResponseHeaders(): array
    {
        return $this->responseHeaders;
    }

    /**
     * Pobranie zawartości odpowiedzi
     *
     * @return string
     */
    public function getResponseBody(): string
    {
        return $this->responseBody;
    }
}
