<?php
/*
 * Client.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Lib\Api\Api;
use AlleKurier\WygodneZwroty\Api\Lib\Api\ApiException;
use AlleKurier\WygodneZwroty\Api\Lib\ApiUrlFormatter\ApiUrlFormatter;
use AlleKurier\WygodneZwroty\Api\Lib\Authorization\Authorization;
use AlleKurier\WygodneZwroty\Api\Lib\Errors\ErrorsFactory;
use AlleKurier\WygodneZwroty\Api\Lib\ResponseParser\ResponseParser;
use Psr\Http\Client\ClientExceptionInterface;

class Client
{
    private const API_URL = 'https://api.allekurier.pl/v1';

    private Api $api;

    /**
     * Konstruktor
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $httpClient = new \GuzzleHttp\Client();
        $apiUrlFormatter = new ApiUrlFormatter();
        $authorization = new Authorization();
        $errorsFactory = new ErrorsFactory();
        $responseParser = new ResponseParser($errorsFactory);

        $this->api = new Api(
            $httpClient,
            $apiUrlFormatter,
            $authorization,
            $responseParser,
            $credentials,
            $this->getApiUrl()
        );
    }

    /**
     * Pobranie adresu API
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return self::API_URL;
    }

    /**
     * Wywołanie komendy API
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ApiException
     * @throws ClientExceptionInterface
     */
    public function call(RequestInterface $request): ResponseInterface
    {
        return $this->api->call($request);
    }
}
