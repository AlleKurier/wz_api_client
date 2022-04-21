<?php

namespace AlleKurier\WygodneZwroty\Api\Model\Request;

class Package implements RequestModelInterface
{
    private float $weight;

    private float $length;

    private float $width;

    private float $height;

    private bool $custom;

    public function __construct(float $weight, float $length, float $width, float $height, bool $custom)
    {
        $this->weight = $weight;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->custom = $custom;
    }

    public function toArray(): array
    {
        return [
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'custom' => $this->custom,
        ];
    }
}
