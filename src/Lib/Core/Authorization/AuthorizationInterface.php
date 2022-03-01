<?php
/*
 * AuthorizationInterface.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace Allekurier\WygodneZwroty\Api\Lib\Core\Authorization;

interface AuthorizationInterface
{
    /**
     * Pobranie nagłówka HTTP
     *
     * @param string $authorizationToken
     * @return string
     */
    public function getHttpHeader(string $authorizationToken): string;
}
