<?php
/*
 * Curl.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Lib\Core\Http;

class Curl implements HttpInterface
{
    private array $headers = [];

    /**
     * {@inheritDoc}
     */
    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function removeHeader(string $key): void
    {
        unset($this->headers[$key]);
    }

    /**
     * {@inheritDoc}
     * @throws HttpException
     */
    public function fetch(string $url, MethodEnum $method, string $requestData): HttpResponse
    {
        $curl = new \Curl\Curl();

        $curl->setHeaders($this->headers);

        switch ($method) {
            case MethodEnum::GET():
                $curl->get($url, $requestData);
                break;
            case MethodEnum::POST():
                $curl->post($url, $requestData);
                break;
            case MethodEnum::PUT():
                $curl->put($url, $requestData);
                break;
            default:
        }

        if ($curl->isError()) {
            if ($curl->getErrorCode() < 100) {
                throw new HttpException(sprintf('Connection error: %s', $curl->getErrorMessage()),
                    $curl->getErrorCode());
            }

            if ($curl->getErrorCode() >= 500) {
                throw new HttpException(sprintf('HTTP error: %s', $curl->getErrorMessage()), $curl->getErrorCode());
            }
        }

        $responseHeadersObject = $curl->getResponseHeaders();

        $responseHeaders = [];
        foreach ($responseHeadersObject as $key => $val) {
            $responseHeaders[$key] = $val;
        }

        /** @var string $responseBody */
        $responseBody = $curl->getRawResponse();

        return new HttpResponse($responseHeaders, $responseBody);
    }
}
