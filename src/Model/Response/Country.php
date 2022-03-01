<?php
/*
 * Country.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Model\Response;

use Allekurier\WygodneZwroty\Api\Lib\Common\Assert\Assert;

class Country implements ResponseModelInterface
{
    private string $code;

    private string $name;

    /**
     * Konstruktor
     *
     * @param string $code
     * @param string $name
     */
    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromArray(array $data): self
    {
        Assert::keyExists($data, 'code');
        Assert::string($data['code']);
        $code = $data['code'];

        Assert::keyExists($data, 'name');
        Assert::string($data['name']);
        $name = $data['name'];

        return new self(
            $code,
            $name
        );
    }

    /**
     * Pobranie kodu kraju
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Pobranie nazwy kraju
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}