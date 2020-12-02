<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\Model;

final class Wind implements \JsonSerializable
{
    private $speed;

    public function __construct(float $speed)
    {
        if ($speed < 0) {
            throw new \InvalidArgumentException();
        }

        $this->speed = $speed;
    }

    public function jsonSerialize(): array
    {
        return [
            'speed' => $this->speed
        ];
    }
}
