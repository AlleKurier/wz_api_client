<?php
/*
 * GetOrderByTrackingNumberRequest.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Command\GetSentOrders;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

class GetSentOrdersRequest implements RequestInterface
{
    /**
     * Data w formacie Y-m-d wg, której pobierana jest lista przesyłek. Gdy null- dzisiejsza data.
     */
    private ?string $date;

    public function __construct(?string $date = null)
    {
        $this->date = $date;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * {@inheritDoc}
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint(): string
    {
        return 'order/sent';
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestData(): array
    {
        return [
            'date' => $this->getDate()
        ];
    }

    public function getParameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getParsedResponse(array $responseHeaders, array $responseData): ResponseInterface
    {
        return new GetSentOrdersResponse($responseData);
    }
}
