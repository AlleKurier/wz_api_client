<?php

namespace AlleKurier\WygodneZwroty\Api\Command\CreatePayment;

class CreateBlikPaymentRequest extends CreatePaymentRequest
{
    /**
     * {@inheritDoc}
     */
    public function getEndpoint(): string
    {
        return 'payment/dotpay-blik';
    }
}
