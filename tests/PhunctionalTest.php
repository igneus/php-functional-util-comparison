<?php

namespace Tests;

use Lambdish\Phunctional as p;
use Tests\Toys\Route;

/**
 * lambdish/phunctional
 */
class PhunctionalTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return p\map(
            function (int $i) {
                return $i * 2;
            },
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return p\pipe(
            p\partial(p\flat_map, function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return p\pipe(
            p\partial('explode', '\\'),
            p\last,
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return p\map(
            p\pipe(
                function ($i) {
                    // The "identity function" at the beginning of the pipe has a purpose:
                    // `map` passes two arguments to it's callback and both are passed
                    // to the first function in the pipe.
                    // if it's partially applied `explode`, the second argument (index)
                    // will be used as splitting limit, which will break the algorithm.
                    // Try to comment this function out and see.
                    return $i;
                },
                p\partial('explode', ':'),
                p\partial(p\map, function (string $numStr) {
                    return (int)$numStr;
                }),
                'array_reverse',
                p\partial(p\map, function (int $num, int $index) {
                    return $num * (60 ** $index);
                }),
                'array_sum'
            ),
            $timestamps
        );
    }
}