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
 * @method static self NOTICE()
 * @method static self WARNING()
 * @method static self CRITICAL()
 */
class ErrorLevelEnum extends AbstractEnum
{
    /**
     * Stała: błąd typu informacyjnego
     */
    private const NOTICE = 'notice';

    /**
     * Stała: błąd z ostrzeżeniem
     */
    private const WARNING = 'warning';

    /**
     * Stała: krytyczny błąd
     */
    private const CRITICAL = 'critical';
}
