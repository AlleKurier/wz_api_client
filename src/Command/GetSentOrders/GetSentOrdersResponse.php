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

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Model\Response\Order;

class GetSentOrdersResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * @var Order[]
     */
    private array $orders;

    public function __construct(array $responseData)
    {
        $orders = [];

        foreach ($responseData['orders'] as $order) {
            $orders[] = Order::createFromArray($order);
        }

        $this->orders = $orders;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }
}
