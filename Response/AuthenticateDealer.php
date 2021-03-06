<?php

/*
 * This file is part of the Galves API
 *
 * (c) Craig Blanchette <craig.blanchette@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Galves\Api\Response;

use Galves\Api\Exception\AuthenticationException;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

class AuthenticateDealer implements ResponseClassInterface
{
    public static function fromCommand(OperationCommand $command)
    {
        $xml = $command->getResponse()->xml();

        if (!isset($xml->AuthInfo)) {
            throw new AuthenticationException((string)$xml, $xml->attributes()['errorcode']);
        }

        $authToken = (string)$xml->AuthInfo->attributes()['authToken'];

        return $authToken;
    }
}
