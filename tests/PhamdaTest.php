<?php

namespace Tests;

use Phamda\Phamda as P;
use Tests\Toys\Route;

/**
 * phamda/phamda
 */
class PhamdaTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return P::map(P::multiply(2))($input);
    }

    public function routes_to_unique_cities(array $input)
    {
        return P::pipe(
            P::flatMap(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return P::pipe(
            P::partial('explode', '\\'),
            P::last(), // even single-argument functions are curried
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return P::map(P::pipe(
            P::identity(),
            P::partial('explode', ':'),
            P::map(function (string $i) { // P::map('intval') doesn't work, arity limiting would be necessary
                return (int) $i;
            }),
            'array_reverse',
            P::zip([0, 1, 2]),
            P::map(function ($pair) {
                list($exponent, $num) = $pair;
                return $num * (60 ** $exponent);
            }),
            'array_sum'
        ))($timestamps);
    }
}