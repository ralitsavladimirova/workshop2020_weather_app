<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider;

use App\Model\Weather;
use App\WeatherProvider\Provider\WeatherProviderInterface;

class CityHandler
{
    /* @var iterable|WeatherProviderInterface[] */
    private $providers;

    public function __construct(iterable $providers)
    {
        $this->providers = $providers;
    }

    public function handle(string $city): Weather
    {
        foreach ($this->providers as $weatherProvider) {
            if ($weatherProvider->supports($city)) {
                return $weatherProvider->getData();
            }
        }

        throw new \InvalidArgumentException('Unsupported city');
    }
}
