<?php

namespace Tests;

use FunctionalUtilTest\functions as myfunctions;
use nspl\a;
use nspl\f;
use nspl\op;
use Tests\Toys\Route;

/**
 * ihor/nspl
 */
class NsplTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return a\map(
            f\partial(op\mul, 2),
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return f\pipe(
            $input,
            f\partial(a\flatMap, function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            'array_unique',
            'array_values' // reset keys
        );
    }

    public function class_to_method_name(string $className)
    {
        return f\pipe(
            $className,
            f\partial('explode', '\\'),
            a\last,
            'lcfirst'
        );
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return a\map(
            f\rpartial(
                f\pipe,
                f\partial('explode', ':'),
                f\partial(a\map, op\int),
                'array_reverse',
                f\rpartial(a\zip, [0, 1, 2]), // nspl doesn't expose collection indices
                f\partial(a\map, function ($pair) {
                    list($num, $exponent) = $pair;
                    return $num * (60 ** $exponent);
                }),
                'array_sum'
            ),
            $timestamps
        );
    }

    public function second_odd_numbers(array $numbers)
    {
        $secondOdd = f\compose(
            function (array $a) {
                return count($a) >= 2 ? a\second($a) : 1;
            },
            f\partial(a\filter, myfunctions\isOdd)
        );

        return f\pipe(
            $numbers,
            f\partial(a\map, $secondOdd),
            f\rpartial('array_chunk', 2),
            f\partial(a\map, f\partial(f\apply, op\mul))
        );
    }
}