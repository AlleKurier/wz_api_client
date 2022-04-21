<?php

namespace AlleKurier\WygodneZwroty\Api\Command\CreateOrder;

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

class CreateOrderResponse extends AbstractResponse implements ResponseInterface
{
    private string $orderHid;

    public function __construct(string $orderHid)
    {
        $this->orderHid = $orderHid;
    }

    public function getOrderHid(): string
    {
        return $this->orderHid;
    }
}
