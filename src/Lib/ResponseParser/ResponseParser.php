<?php
/*
 * ResponseParser.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Lib\ResponseParser;

use AlleKurier\WygodneZwroty\Api\Command\RequestInterface;
use AlleKurier\WygodneZwroty\Api\Command\ResponseInterface;
use AlleKurier\WygodneZwroty\Api\Lib\Errors\ErrorsFactoryInterface;

class ResponseParser implements ResponseParserInterface
{
    private ErrorsFactoryInterface $errorsFactory;

    /**
     * @param ErrorsFactoryInterface $errorsFactory
     */
    public function __construct(ErrorsFactoryInterface $errorsFactory)
    {
        $this->errorsFactory = $errorsFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getParsedResponse(
        RequestInterface $request,
        array $responseHeaders,
        array $responseData
    ): ResponseInterface {
        if (!empty($responseData['failure'])) {
            return $this->errorsFactory->createFromResponse($responseData);
        } else {
            return $request->getParsedResponse($responseHeaders, $responseData['data']);
        }
    }
}
