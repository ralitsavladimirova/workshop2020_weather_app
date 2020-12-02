<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider\Handler;

use App\Model\Weather;
use Symfony\Contracts\Cache\CacheInterface;

class CachedCityHandler implements CityHandlerInterface
{
    private $cache;
    private $cityHandler;

    public function __construct(CacheInterface $cache, CityHandler $cityHandler)
    {
        $this->cache = $cache;
        $this->cityHandler = $cityHandler;
    }

    public function handle(string $city): Weather
    {
        $cacheKey = md5($city . (new \DateTime())->format('Y-m-d'));

        return $this->cache->get($cacheKey, function () use ($city) {
            return $this->cityHandler->handle($city);
        });
    }
}
