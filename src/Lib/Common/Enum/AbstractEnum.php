<?php
/*
 * AbstractEnum.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Lib\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * @see https://github.com/myclabs/php-enum
 *
 * @example
 *
 * // @method static self view()
 * class Action extends AbstractEnum
 * {
 *     private const view = 'view';
 *     private const edit = 'edit';
 * }
 *
 * $action = Action::view();
 * or
 * $action = new Action($value);
 *
 */
abstract class AbstractEnum extends Enum
{
}
