<?php

namespace Tests;

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
}