<?php

namespace Tests;

use Krak\Fn as k;
use Krak\Fn\Curried as c;
use Tests\Toys\Route;

/**
 * krak/fn
 */
class KrakFnTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        // produces a generator, not an array!
        return iterator_to_array(k\map(
            function (int $i) {
                return $i * 2;
            },
            $input
        ));
    }

    public function routes_to_unique_cities(array $input)
    {
        return k\pipe(
            c\flatMap(function (Route $route) { // RED ALERT: entries get lost in this step! There is a bug somewhere!
                return [$route->getFrom(), $route->getTo()];
            }),
            'iterator_to_array', // flatMap, again, produces a generator
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return k\pipe(
            k\partial('explode', '\\'),
            function (array $a) { // no function to get the last array element provided
                return $a[count($a) - 1];
            },
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        // the required amount of `iterator_to_array` is extreme here. Is there a better way to use this library?
        return iterator_to_array(c\map(k\pipe(
            k\partial('explode', ':'),
            c\map('intval'),
            'iterator_to_array',
            'array_reverse',
            k\partial(k\zip, [0, 1, 2]),
            c\map(function ($pair) {
                list($exponent, $num) = $pair;
                return $num * (60 ** $exponent);
            }),
            'iterator_to_array',
            'array_sum'
        ))($timestamps));
    }
}