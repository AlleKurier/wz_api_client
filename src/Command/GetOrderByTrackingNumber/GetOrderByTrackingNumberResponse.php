<?php
/*
 * GetOrderByTrackingNumberResponse.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber;

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Model\Response\Order;

class GetOrderByTrackingNumberResponse extends AbstractResponse implements ResponseInterface
{
    private Order $order;

    /**
     * Konstruktor
     *
     * @param array $responseData
     */
    public function __construct(array $responseData)
    {
        $this->order = Order::createFromArray($responseData['order']);
    }

    /**
     * Pobranie danych przesyłki
     *
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
