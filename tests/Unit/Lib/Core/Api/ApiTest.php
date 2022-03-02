<?php
/*
 * ApiTest.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace AlleKurier\WygodneZwroty\ApiTests\Unit\Lib\Core\Api;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Credentials;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Api\Api;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Api\ApiException;
use AlleKurier\WygodneZwroty\Api\Lib\Core\ApiUrlFormatter\ApiUrlFormatterInterface;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Authorization\AuthorizationInterface;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Http\HttpInterface;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Http\HttpResponse;
use AlleKurier\WygodneZwroty\Api\Lib\Core\Http\MethodEnum;
use AlleKurier\WygodneZwroty\Api\Lib\Core\ResponseParser\ResponseParserInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private const TEST_API_URL = 'https://test.api.com';

    private Api $api;

    /**
     * @var MockObject|HttpInterface
     */
    private MockObject $http;

    /**
     * @var MockObject|ApiUrlFormatterInterface
     */
    private MockObject $apiUrlFormatter;

    /**
     * @var MockObject|AuthorizationInterface
     */
    private MockObject $authorization;

    /**
     * @var MockObject|ResponseParserInterface
     */
    private MockObject $responseParser;

    /**
     * @var MockObject|Credentials
     */
    private MockObject $credentials;

    /**
     * @var MockObject|RequestInterface
     */
    private MockObject $request;

    /**
     * @var MockObject|HttpResponse
     */
    private MockObject $httpResponse;

    /**
     * @var MockObject|ResponseInterface
     */
    private MockObject $response;

    public function setUp(): void
    {
        $this->http = $this->createMock(HttpInterface::class);
        $this->apiUrlFormatter = $this->createMock(ApiUrlFormatterInterface::class);
        $this->authorization = $this->createMock(AuthorizationInterface::class);
        $this->responseParser = $this->createMock(ResponseParserInterface::class);
        $this->credentials = $this->createMock(Credentials::class);

        $this->request = $this->createMock(RequestInterface::class);
        $this->httpResponse = $this->createMock(HttpResponse::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->api = new Api(
            $this->http,
            $this->apiUrlFormatter,
            $this->authorization,
            $this->responseParser,
            $this->credentials,
            self::TEST_API_URL
        );
    }

    /**
     * @throws ApiException
     */
    public function test_call(): void
    {
        $credentialsCode = 'testcode';
        $credentialsToken = 'testtoken';
        $requestData = [];
        $httpAuthorizationHeader = 'Basic ' . base64_encode($credentialsToken);
        $httpMethod = MethodEnum::GET();

        $formattedUrl = self::TEST_API_URL . '/testcode/order/trackingnumber/12345678';

        $responseHeaders = [];
        $responseBody = '{"errors":[],"mainError":{},"failure":false,"successful":true}';

        $this->credentials
            ->method('getCode')
            ->willReturn($credentialsCode);

        $this->credentials
            ->method('getToken')
            ->willReturn($credentialsToken);

        $this->apiUrlFormatter
            ->method('getFormattedUrl')
            ->with(self::TEST_API_URL, $credentialsCode, $this->request)
            ->willReturn($formattedUrl);

        $this->request
            ->method('getRequestData')
            ->willReturn($requestData);

        $this->request
            ->method('getHttpMethod')
            ->willReturn($httpMethod);

        $this->authorization
            ->method('getHttpHeader')
            ->with($credentialsToken)
            ->willReturn($httpAuthorizationHeader);

        $this->http
            ->method('removeHeader')
            ->with('Authorization');

        $this->http
            ->method('addHeader')
            ->with('Authorization', $httpAuthorizationHeader);

        $this->http
            ->method('fetch')
            ->with($formattedUrl, $httpMethod, json_encode($requestData))
            ->willReturn($this->httpResponse);

        $this->httpResponse
            ->method('getResponseHeaders')
            ->willReturn($responseHeaders);

        $this->httpResponse
            ->method('getResponseBody')
            ->willReturn($responseBody);

        $this->responseParser
            ->expects(self::once())
            ->method('getParsedResponse')
            ->with($this->request, $responseHeaders, json_decode($responseBody, true))
            ->willReturn($this->response);

        $response = $this->api->call(
            $this->request
        );

        $this->assertSame($this->response, $response);
    }
}
