<?php

namespace Tests;

use _;
use Tests\Toys\Route;

/**
 * lodash-php/lodash-php
 */
class LodashPhpTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return _\map(
            $input,
            function (int $i) {
                return $i * 2;
            }
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return array_values(array_unique(_\flatMap(
            $input,
            function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }
        )));
    }

    public function class_to_method_name(string $className)
    {
        return _\lowerFirst(_\last(explode('\\', $className)));
    }
}