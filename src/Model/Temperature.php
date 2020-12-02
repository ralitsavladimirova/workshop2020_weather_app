<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\Model;

final class Temperature implements \JsonSerializable
{
    private $degrees;

    public function __construct(float $temperature)
    {
        $this->degrees = $temperature;
    }

    public function jsonSerialize(): array
    {
        return [
            'degrees' => $this->degrees
        ];
    }
}
