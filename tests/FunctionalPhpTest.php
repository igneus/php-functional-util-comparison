<?php

namespace Tests;

use Functional as F;
use Functional\Functional as FF;
use FunctionalUtilTest\functions as myfunctions;
use Tests\Toys\Route;

/**
 * lstrojny/functional-php
 */
class FunctionalPhpTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return F\map(
            $input,
            function (int $i) {
                return $i * 2;
            }
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return F\compose(
            F\partial_right(
                FF::flat_map, // function names as class constants
                function (Route $route) {
                    return [$route->getFrom(), $route->getTo()];
                }
            ),
            'array_unique',
            'array_values'
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return F\compose(
            F\partial_left('explode', '\\'),
            F\partial_left(FF::last),
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return F\map(
            $timestamps,
            F\compose(
                F\partial_left('explode', ':'),
                F\partial_right(
                    FF::map,
                    F\ary('intval', 1) // ary() prevents passing additional arguments by map()
                ),
                'array_reverse',
                F\partial_right(FF::map, function (int $num, int $index) { // 'map' with index is useful
                    return $num * (60 ** $index);
                }),
                'array_sum'
            )
        );
    }

    public function second_odd_numbers(array $numbers)
    {
        $second = F\compose(
            'array_values',
            F\partial_right(FF::pick, 1)
        );

        $secondOdd = F\compose(
            F\partial_right(FF::select, myfunctions\isOdd),
            function (array $a) use ($second) {
                return count($a) >= 2 ? $second($a) : 1;
            }
        );

        return F\compose(
            F\partial_right(FF::map, $secondOdd),
            'dump',
            F\partial_right('array_chunk', 2),
            'dump',
            F\partial_right(
                FF::map,
                F\ary(  // ary() prevents passing additional arguments by map()
                    F\partial_left(
                        'call_user_func_array',
                        function ($a, $b) { return $a * $b; }
                    ),
                    1
                )
            )
        )($numbers);
    }
}
