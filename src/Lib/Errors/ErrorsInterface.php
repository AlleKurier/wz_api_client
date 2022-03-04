<?php
/*
 * ErrorsInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace AlleKurier\WygodneZwroty\Api\Lib\Errors;

use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;

interface ErrorsInterface extends ResponseInterface
{
    /**
     * Pobranie listy błędów
     *
     * @return Error[]
     */
    public function getErrors(): array;
}
