<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider\Provider;

use App\Model\Weather;

interface WeatherProviderInterface
{
    public function supports(string $city): bool;

    public function getData(): Weather;
}
