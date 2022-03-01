<?php
/*
 * MethodEnum.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Lib\Core\Http;

use Allekurier\WygodneZwroty\Api\Lib\Common\Enum\AbstractEnum;

/**
 * @method static self GET()
 * @method static self POST()
 * @method static self PUT()
 */
class MethodEnum extends AbstractEnum
{
    /**
     * Stała: metoda GET
     */
    private const GET = 'GET';

    /**
     * Stała: metoda POST
     */
    private const POST = 'POST';

    /**
     * Stała: metoda PUT
     */
    private const PUT = 'PUT';
}
