<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\WeatherProvider\Handler;

use App\Model\Weather;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedCityHandler implements CityHandlerInterface
{
    private $cache;
    private $cityHandler;

    public function __construct(CacheInterface $cache, CityHandlerInterface $cityHandler)
    {
        $this->cache = $cache;
        $this->cityHandler = $cityHandler;
    }

    public function handle(string $city): Weather
    {
        $cacheKey = md5($city . (new \DateTime())->format('Y-m-d'));

        return $this->cache->get($cacheKey, function (ItemInterface $cacheItem) use ($city) {
            $cacheItem->expiresAfter(60);

            return $this->cityHandler->handle($city);
        });
    }
}
