<?php

declare(strict_types=1);

namespace HydratorWorkshop;

class HydratorTest
{
    public static function start(object $object, array $data, object $hydrator)
    {
        $hydrator->hydrate($data, $object);
        $hydrator->extract($object);
    }
}
