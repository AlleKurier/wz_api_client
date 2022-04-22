<?php

namespace AlleKurier\WygodneZwroty\Api\Command\GetOrderByHid;

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Model\Response\Order;

class GetOrderByHidResponse extends AbstractResponse implements ResponseInterface
{
    private Order $order;

    public function __construct(array $responseData)
    {
        $this->order = Order::createFromArray($responseData['order']);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
