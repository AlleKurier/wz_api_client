<?php

namespace AlleKurier\WygodneZwroty\Api\Command\CreateOrder;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Model\Request\Order;

class CreateOrderRequest implements RequestInterface
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return 'return-order';
    }

    public function getRequestData(): array
    {
        return $this->order->toArray();
    }

    public function getParameters(): array
    {
        return [];
    }

    public function getParsedResponse(array $responseHeaders, array $responseData): ResponseInterface
    {
        return new CreateOrderResponse($responseData['order_hid']);
    }
}
