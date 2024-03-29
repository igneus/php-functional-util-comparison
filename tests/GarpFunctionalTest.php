<?php

namespace Tests;

use FunctionalUtilTest\functions as myfunctions;
use Garp\Functional as f;

use Tests\Toys\Route;

/**
 * grrr-amsterdam/garp-functional
 */
class GarpFunctionalTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return f\map(f\multiply(2))($input);
    }

    public function routes_to_unique_cities(array $input)
    {
        return f\pipe(
            f\map(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            f\flatten,
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return f\pipe(
            f\partial('explode', '\\'),
            f\last,
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return f\map(
                f\pipe(
                f\partial('explode', ':'),
                f\map('intval'),
                'array_reverse',
                f\partial_right(f\zip, [0, 1, 2]),
                f\map(function ($pair) {
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
        $second = f\compose(f\last, f\take(2));
        $secondOdd = f\compose(
            function (array $a) use ($second) {
                return count($a) >= 2 ? $second($a) : 1;
            },
            f\filter(myfunctions\isOdd)
        );

        return f\pipe(
            f\map($secondOdd),
            f\partial_right('array_chunk', 2),
            f\map(f\partial('call_user_func_array', f\multiply))
        )($numbers);
    }
}