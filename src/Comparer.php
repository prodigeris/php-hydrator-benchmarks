<?php

declare(strict_types=1);

namespace HydratorWorkshop;

class Comparer
{
    public static function compare($min, $current): array
    {
        if($min === $current) {
            return [
                42,
                0,
                0,
            ];
        }
        return [
            41,
            $current - $min,
            $current / $min * 100,
        ];
    }
}
