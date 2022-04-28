<?php

namespace AlleKurier\WygodneZwroty\Api\Command\GetOrderLabels;

use AlleKurier\WygodneZwroty\Api\Command\AbstractResponse;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

class GetOrderLabelsResponse extends AbstractResponse implements ResponseInterface
{
    private string $labelsContent;

    public function __construct(array $responseData)
    {
        $this->labelsContent = $responseData['labelsContent'];
    }

    public function getLabelsContent(): string
    {
        return $this->labelsContent;
    }
}
