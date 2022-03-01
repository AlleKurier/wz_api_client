<?php
/*
 * GetOrderByTrackingNumberRequest.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber;

use Allekurier\WygodneZwroty\Api\Command\RequestInterface;
use Allekurier\WygodneZwroty\Api\Command\ResponseInterface;
use Allekurier\WygodneZwroty\Api\Lib\Core\Http\MethodEnum;

class GetOrderByTrackingNumberRequest implements RequestInterface
{
    private string $trackingNumber;

    /**
     * Konstruktor
     *
     * @param string $trackingNumber
     */
    public function __construct(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * Pobranie numeru śledzenia
     *
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * {@inheritDoc}
     */
    public function getHttpMethod(): MethodEnum
    {
        return MethodEnum::GET();
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint(): string
    {
        return sprintf('order/trackingnumber/%s', $this->trackingNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestData(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getParsedResponse(array $responseHeaders, array $responseData): ResponseInterface
    {
        return new GetOrderByTrackingNumberResponse($responseData);
    }
}
