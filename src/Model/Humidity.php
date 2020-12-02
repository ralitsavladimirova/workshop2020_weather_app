<?php
/**
 * @author Ralitsa Radeva <ralica.radeva@gmail.com>
 * @copyright (c) 2020
 */

namespace App\Model;

final class Humidity implements \JsonSerializable
{
    private $percent;

    public function __construct(int $percent)
    {
        if ($percent < 0 || $percent > 100) {
            throw new \InvalidArgumentException();
        }

        $this->percent = $percent;
    }

    public function jsonSerialize(): array
    {
        return [
            'percent' => $this->percent
        ];
    }
}
