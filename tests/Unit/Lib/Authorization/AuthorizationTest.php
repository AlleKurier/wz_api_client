<?php
/*
 * AuthorizationTest.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

namespace AlleKurier\WygodneZwroty\ApiTests\Unit\Lib\Core\Authorization;

use AlleKurier\WygodneZwroty\Api\Lib\Authorization\Authorization;
use AlleKurier\WygodneZwroty\Api\Lib\Authorization\AuthorizationInterface;
use PHPUnit\Framework\TestCase;

class AuthorizationTest extends TestCase
{
    private AuthorizationInterface $authorization;

    public function setUp(): void
    {
        $this->authorization = new Authorization();
    }

    public function test_get_http_header(): void
    {
        $token = 'TestToken';

        $authorization = $this->authorization->getHttpHeader($token);

        $expectedOutput = 'Basic ' . base64_encode($token);

        $this->assertEquals($expectedOutput, $authorization);
    }
}
