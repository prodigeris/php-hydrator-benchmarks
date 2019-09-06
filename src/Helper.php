<?php

declare(strict_types=1);

namespace HydratorWorkshop;

class Helper
{
    public static function formatBytes($bytes, $precision = 2) {
        $base = log($bytes) / log(1024);
        $suffix = array('B', 'KB', 'MB', 'GB', 'TB');
        $f_base = floor($base);
        return round(1024 ** ($base - floor($base)), 1) . $suffix[(int) $f_base];
    }

    public static function formatDiff($diff, $percentage, ?callable $diffFormatter = null)
    {
        if(0 === $diff) {
            return '';
        }
        $diff = null === $diffFormatter ? $diff : $diffFormatter($diff);

        return sprintf('(+%s %s%%)', $diff, number_format($percentage));
    }
}
