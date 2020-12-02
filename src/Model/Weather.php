<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\Model;

final class Weather implements \JsonSerializable
{
    private $temperature;
    private $humidity;
    private $wind;

    public function __construct(Temperature $temperature, Humidity $humidity, Wind $wind = null)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->wind = $wind;
    }

    public function jsonSerialize(): array
    {
        return [
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'wind' => $this->wind,
        ];
    }
}
