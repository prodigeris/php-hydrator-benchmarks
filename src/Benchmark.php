<?php

declare(strict_types=1);

namespace HydratorWorkshop;

class Benchmark
{
    private static $max, $memory;

    public static function memoryTick(): void
    {
        self::$memory = memory_get_usage() - self::$memory;
        self::$max = self::$memory > self::$max ? self::$memory : self::$max;
        self::$memory = memory_get_usage();
    }

    public static function benchmarkMemory(callable $function, $args = null, int $iterations = 10000): array
    {
        declare(ticks=1);
        self::$max = 0;
        self::$memory = memory_get_usage();


        $startTime = microtime(true);

        register_tick_function('call_user_func_array', [self::class, 'memoryTick'], []);
        for ($i = 0; $i < $iterations; ++$i) {
            is_array($args) ?
                call_user_func_array($function, $args) :
                $function();
        }
        unregister_tick_function('call_user_func_array');

        $endTime = microtime(true) - $startTime;

        return [
            'memory' => self::$max,
            'time' => $endTime,
        ];
    }
}
