<?php

namespace Tests;

use Functional as F;
use Functional\Functional as FF;
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
}