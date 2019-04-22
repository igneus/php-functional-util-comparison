<?php

namespace Tests;

use Tests\Toys\Route;
use DaveRoss\FunctionalProgrammingUtils as f;

/**
 * daveross/functional-programming-utils
 */
class DaverossTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return array_map(
            // function referencing ugly
            f\partially_apply('DaveRoss\FunctionalProgrammingUtils\multiply', 2),
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        // only compose, no pipe
        return f\compose(
            'array_values', // reset keys
            'array_unique',
            function ($routes) {
                // no flatMap() or flatten() - this library generally lacks common collection utilities
                $r = [];
                foreach ($routes as $route) {
                    $r[] = $route->getFrom();
                    $r[] = $route->getTo();
                }
                return $r;
            }
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return f\compose(
            'lcfirst',
            // no collection utilities (`last()` here), as already mentioned
            function (array $a) {
                return end($a);
            },
            f\partially_apply('explode', '\\')
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return array_map(
            f\compose(
                'array_sum',
                f\partially_apply('array_map', function ($pair) {
                    list($exponent, $num) = $pair;
                    return $num * (60 ** $exponent);
                }),
                function (array $a) {
                    // again, missing collection utilities
                    $r = [];
                    foreach ($a as $index => $value) {
                        $r[] = [$index, $value];
                    }
                    return $r;
                },
                'array_reverse',
                f\partially_apply('array_map', 'intval'),
                f\partially_apply('explode', ':')
            ),
            $timestamps
        );
    }
}