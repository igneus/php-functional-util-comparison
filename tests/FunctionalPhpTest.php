<?php

namespace Tests;

use Functional as F;
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
                '\Functional\flat_map', // lack of constants matching function names hurts when composing
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
            F\partial_left('\Functional\last'),
            'lcfirst'
        )($className);
    }
}