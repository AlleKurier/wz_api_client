<?php
/*
 * GetOrderByTrackingNumberResponse.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Command\GetOrderByTrackingNumber;

use Allekurier\WygodneZwroty\Api\Command\AbstractResponse;
use Allekurier\WygodneZwroty\Api\Command\ResponseInterface;
use Allekurier\WygodneZwroty\Api\Lib\Common\Assert\Assert;
use Allekurier\WygodneZwroty\Api\Model\Response\Order;

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
        Assert::keyExists($responseData, 'order');

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
