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
    private $expiresAfter;
    
    public function __construct(CacheInterface $cache, CityHandlerInterface $cityHandler, $expiresAfter = 60)
    {
        $this->cache = $cache;
        $this->cityHandler = $cityHandler;
        $this->expiresAfter = $expiresAfter;
    }

    public function handle(string $city): Weather
    {
        $cacheKey = md5($city . (new \DateTime())->format('Y-m-d'));

        return $this->cache->get($cacheKey, function (ItemInterface $cacheItem) use ($city) {
            $cacheItem->expiresAfter($this->expiresAfter);

            return $this->cityHandler->handle($city);
        });
    }
}
