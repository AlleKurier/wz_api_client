<?php
/*
 * Uuid.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Lib\Common\Uuid;

use InvalidArgumentException;

/**
 * @see https://uuid.ramsey.dev/
 */
class Uuid
{
    private string $uuid;

    /**
     * Konstruktor
     *
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        if (!\Ramsey\Uuid\Uuid::isValid($uuid)) {
            throw new InvalidArgumentException('Wrong UUID format');
        }

        $this->uuid = $uuid;
    }

    /**
     * Pobranie UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Pobranie UUID
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getUuid();
    }
}
