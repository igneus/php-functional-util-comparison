<?php

namespace Tests;

use Krak\Fun\{f, c};
use Tests\Toys\Route;

/**
 * krak/fn
 */
class KrakFnTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        // produces a generator, not an array!
        return f\arrayMap(
            function (int $i) {
                return $i * 2;
            },
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return f\pipe(
            c\flatMap(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            c\toArray, // flatMap, again, produces a generator
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return f\pipe(
            f\partial('explode', '\\'),
            function (array $a) { // no function to get the last array element provided
                return $a[count($a) - 1];
            },
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        // the required amount of `iterator_to_array` is extreme here. Is there a better way to use this library?
        return f\arrayMap(f\pipe(
            f\partial('explode', ':'),
            c\arrayMap('intval'),
            'array_reverse',
            c\toPairs,
            c\arrayMap(function ($pair) {
                list($exponent, $num) = $pair;
                return $num * (60 ** $exponent);
            }),
            'array_sum'
        ), $timestamps);
    }
}