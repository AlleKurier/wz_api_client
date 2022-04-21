<?php

namespace AlleKurier\WygodneZwroty\Api\Model\Request;

class Order implements RequestModelInterface
{
    /** @see \AlleKurier\WygodneZwroty\Api\Model\ServiceCode */
    private string $serviceCode;

    private Sender $sender;

    /** @var Package[] */
    private array $packages;

    /** @var ?AdditionalField[] */
    private ?array $additionalFields;

    public function __construct(string $serviceCode, Sender $sender, array $packages, ?array $additionalFields = null)
    {
        $this->serviceCode = $serviceCode;
        $this->sender = $sender;
        $this->packages = $packages;
        $this->additionalFields = $additionalFields;
    }

    public function toArray(): array
    {
        $orderArray['service_code'] = $this->serviceCode;
        $orderArray['sender'] = $this->sender->toArray();

        foreach ($this->packages as $package) {
            $orderArray['packages'][] = $package->toArray();
        }

        foreach ($this->additionalFields as $additionalField) {
            $orderArray['additional_fields'][] = $additionalField->toArray();
        }

        return $orderArray;
    }
}