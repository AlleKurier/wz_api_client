<?php
/*
 * Authorization.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Lib\Core\Authorization;

class Authorization implements AuthorizationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getHttpHeader(string $authorizationToken): string
    {
        return sprintf('Basic %s', base64_encode($authorizationToken));
    }
}
