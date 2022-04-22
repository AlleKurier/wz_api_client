<?php

namespace AlleKurier\WygodneZwroty\Api\Command\CreatePayment;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

class CreatePaymentRequest implements RequestInterface
{
    /**
     * @var string[]
     */
    private array $orderHids;

    private string $returnUrl;

    public function __construct(array $orderHids, string $returnUrl)
    {
        $this->orderHids = $orderHids;

        $this->returnUrl = $returnUrl;
    }

    /**
     * @return string[]
     */
    public function getOrderHids(): array
    {
        return $this->orderHids;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint(): string
    {
        return 'payment/dotpay';
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestData(): array
    {
        return [
            'orders' => $this->orderHids,
            'returnUrl' => $this->returnUrl,
        ];
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
        return new CreatePaymentResponse($responseData);
    }
}
