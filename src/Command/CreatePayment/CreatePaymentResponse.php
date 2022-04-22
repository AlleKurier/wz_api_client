<?php

namespace AlleKurier\WygodneZwroty\Api\Command\CreatePayment;

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

class CreatePaymentResponse extends AbstractResponse implements ResponseInterface
{
    private string $paymentLink;

    public function __construct(array $responseData)
    {
        $this->paymentLink = $responseData['link'];
    }

    public function getPaymentLink(): string
    {
        return $this->paymentLink;
    }
}