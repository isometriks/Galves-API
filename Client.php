<?php

/*
 * This file is part of the Galves API
 *
 * (c) Craig Blanchette <craig.blanchette@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Galves\Api;

use Galves\Api\EventListener\AuthTokenSubscriber;
use Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;

class Client extends GuzzleClient
{
    public function __construct($baseUrl = '', $config = null)
    {
        parent::__construct($baseUrl, $config);

        $this->setDescription(ServiceDescription::factory(__DIR__.'/api.json'));
        $this->addSubscriber(new CookiePlugin(new ArrayCookieJar()));
    }

    public function login(array $credentials)
    {
        // Run command
        $authToken = $this->call('AuthenticateDealer', $credentials);

        // Now add the subscriber
        $this->addSubscriber(new AuthTokenSubscriber($authToken));

        return $authToken;
    }

    public function getYears()
    {
        return $this->call('GetYears');
    }

    public function getMakes()
    {
        return $this->call('GetMakes');
    }

    public function getModels($year, $make)
    {
        return $this->call('GetModels', array(
            'year' => $year,
            'make' => $make,
        ));
    }

    public function getStyles($year, $make, $model)
    {
        return $this->call('GetStyles', array(
            'year' => $year,
            'make' => $make,
            'model' => $model,
        ));
    }

    public function getVehicle($guid)
    {
        return $this->call('GetVehicle', array(
            'guid' => $guid,
        ));
    }

    public function getMileageAdjustment($guid, $mileage)
    {
        return $this->call('GetMileageAdjustment', array(
            'guid' => $guid,
            'mileage' => $mileage,
        ));
    }

    public function call($command, $data = array())
    {
        return $this->execute($this->getCommand($command, $data));
    }
}
