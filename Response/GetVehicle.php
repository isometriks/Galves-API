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

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

class GetVehicle implements ResponseClassInterface
{
    public static function fromCommand(OperationCommand $command)
    {
        $xml = $command->getResponse()->xml();

        return json_decode(json_encode($xml->Vehicle), true);
    }
}
