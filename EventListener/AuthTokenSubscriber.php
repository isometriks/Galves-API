<?php

/*
 * This file is part of the Galves API
 *
 * (c) Craig Blanchette <craig.blanchette@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Galves\Api\EventListener;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthTokenSubscriber implements EventSubscriberInterface
{
    protected $authToken;

    public function __construct($authToken)
    {
        $this->authToken = $authToken;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'request.before_send'   => array('onRequestBeforeSend', 255),
        );
    }

    public function onRequestBeforeSend(Event $event)
    {
        /* @var $request \Guzzle\Http\Message\Request */
        $request = $event['request'];
        $query = $request->getQuery();

        if (!$query->hasKey('authToken')) {
            $query->add('authToken', $this->authToken);
        }
    }
}
