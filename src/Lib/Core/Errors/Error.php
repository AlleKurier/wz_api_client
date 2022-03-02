<?php
/*
 * Error.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Lib\Core\Errors;

class Error
{
    private string $message;

    private ?string $code;

    private ErrorLevelEnum $level;

    /**
     * Konstruktor
     *
     * @param string $message
     * @param string|null $code
     * @param ErrorLevelEnum $level
     */
    public function __construct(string $message, ?string $code, ErrorLevelEnum $level)
    {
        $this->message = $message;
        $this->code = $code;
        $this->level = $level;
    }

    /**
     * Pobranie opisu błędu
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Pobranie kodu błędu
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Pobranie poziomu błędu
     *
     * @return ErrorLevelEnum
     */
    public function getLevel(): ErrorLevelEnum
    {
        return $this->level;
    }
}
