<?php

namespace AlleKurier\WygodneZwroty\Api\Model\Request;

class AdditionalField implements RequestModelInterface
{
    private string $name;

    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
