<?php
/*
 * ErrorsInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace Allekurier\WygodneZwroty\Api\Lib\Core\Errors;

use Allekurier\WygodneZwroty\Api\Command\ResponseInterface;

interface ErrorsInterface extends ResponseInterface
{
    /**
     * Pobranie listy błędów
     *
     * @return Error[]
     */
    public function getErrors(): array;
}
