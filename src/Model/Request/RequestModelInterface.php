<?php

namespace AlleKurier\WygodneZwroty\Api\Model\Request;

interface RequestModelInterface
{
    /**
     * Utworzenie danych do requestu
     */
    public function toArray(): array;
}
