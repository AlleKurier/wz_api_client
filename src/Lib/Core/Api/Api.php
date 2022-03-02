<?php
/*
 * Api.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Lib\Core\Api;

use Allekurier\WygodneZwroty\Api\Command\RequestInterface;
use Allekurier\WygodneZwroty\Api\Command\ResponseInterface;
use Allekurier\WygodneZwroty\Api\Credentials;
use Allekurier\WygodneZwroty\Api\Lib\Core\ApiUrlFormatter\ApiUrlFormatterInterface;
use Allekurier\WygodneZwroty\Api\Lib\Core\Authorization\AuthorizationInterface;
use Allekurier\WygodneZwroty\Api\Lib\Core\Http\HttpInterface;
use Allekurier\WygodneZwroty\Api\Lib\Core\ResponseParser\ResponseParserInterface;

class Api
{
    private const HTTP_HEADER_AUTORIZATION = 'Authorization';

    private HttpInterface $http;

    private ApiUrlFormatterInterface $apiUrlFormatter;

    private AuthorizationInterface $authorization;

    private ResponseParserInterface $responseParser;

    private Credentials $credentials;

    private string $apiUrl;

    /**
     * Konstruktor
     *
     * @param HttpInterface $http
     * @param ApiUrlFormatterInterface $apiUrlFormatter
     * @param AuthorizationInterface $authorization
     * @param ResponseParserInterface $responseParser
     * @param Credentials $credentials
     * @param string $apiUrl
     */
    public function __construct(
        HttpInterface $http,
        ApiUrlFormatterInterface $apiUrlFormatter,
        AuthorizationInterface $authorization,
        ResponseParserInterface $responseParser,
        Credentials $credentials,
        string $apiUrl
    ) {
        $this->http = $http;
        $this->apiUrlFormatter = $apiUrlFormatter;
        $this->authorization = $authorization;
        $this->responseParser = $responseParser;
        $this->credentials = $credentials;
        $this->apiUrl = $apiUrl;

        $this->http->addHeader('Content-Type', 'application/json');
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
        $url = $this->apiUrlFormatter->getFormattedUrl(
            $this->apiUrl,
            $this->credentials->getCode(),
            $request
        );

        $requestData = $request->getRequestData();
        $requestDataString = json_encode($requestData);

        $authorizationHeader = $this->authorization->getHttpHeader($this->credentials->getToken());

        $this->http->removeHeader(self::HTTP_HEADER_AUTORIZATION);
        $this->http->addHeader(self::HTTP_HEADER_AUTORIZATION, $authorizationHeader);

        $httpMethod = $request->getHttpMethod();

        $response = $this->http->fetch(
            $url,
            $httpMethod,
            $requestDataString
        );

        $responseHeaders = $response->getResponseHeaders();
        $responseBody = $response->getResponseBody();

        $responseData = json_decode($responseBody, true);
        if (is_null($responseData)) {
            throw new ApiException('Response data are not in JSON format.');
        }

        return $this->responseParser->getParsedResponse(
            $request,
            $responseHeaders,
            $responseData
        );
    }
}
