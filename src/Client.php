<?php
/*
 * Client.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api;

use Allekurier\WygodneZwroty\Api\Command\RequestInterface;
use Allekurier\WygodneZwroty\Api\Command\ResponseInterface;
use Allekurier\WygodneZwroty\Api\Lib\Core\Api\Api;
use Allekurier\WygodneZwroty\Api\Lib\Core\Api\ApiException;
use Allekurier\WygodneZwroty\Api\Lib\Core\ApiUrlFormatter\ApiUrlFormatter;
use Allekurier\WygodneZwroty\Api\Lib\Core\Authorization\Authorization;
use Allekurier\WygodneZwroty\Api\Lib\Core\Errors\ErrorsFactory;
use Allekurier\WygodneZwroty\Api\Lib\Core\Http\Curl;
use Allekurier\WygodneZwroty\Api\Lib\Core\ResponseParser\ResponseParser;

class Client
{
    private const API_URL = 'https://new.allekurier.pl/api/v1';

    private Api $api;

    /**
     * Konstruktor
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $http = new Curl();
        $apiUrlFormatter = new ApiUrlFormatter();
        $authorization = new Authorization();
        $errorsFactory = new ErrorsFactory();
        $responseParser = new ResponseParser($errorsFactory);

        $this->api = new Api(
            $http,
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
     */
    public function call(RequestInterface $request): ResponseInterface
    {
        return $this->api->call($request);
    }
}
