<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider\Handler;


use App\Model\Weather;

interface CityHandlerInterface
{
    public function handle(string $city): Weather;
}