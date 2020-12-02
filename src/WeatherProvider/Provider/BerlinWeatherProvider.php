<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider\Provider;

use App\Model\Humidity;
use App\Model\Temperature;
use App\Model\Weather;
use App\Model\Wind;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BerlinWeatherProvider implements WeatherProviderInterface
{
    private const ENDPOINT = 'berlin.json';

    private $client;

    public function __construct(HttpClientInterface $titouanClient)
    {
        $this->client = $titouanClient;
    }

    public function supports(string $city): bool
    {
        return str_contains(self::ENDPOINT, strtolower($city));
    }

    public function getData(): Weather
    {
        $data = json_decode($this->client->request('GET', self::ENDPOINT)->getContent());

        return new Weather(
            new Temperature($data->measure->temp),
            new Humidity($data->measure->humidity * 100),
            new Wind($data->measure->wind)
        );
    }

}
