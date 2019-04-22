<?php

namespace Tests;

use Tests\Toys\Route;
use P;

/**
 * kapolos/pramda
 */
class PramdaTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        // map() returns generator; toArray() is not curried
        return P::toArray(P::map(
            P::multiply(2),
            $input
        ));
    }

    public function routes_to_unique_cities(array $input)
    {
        return P::pipe(
            P::map(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            // single-argument functions are not curried (and cannot be - currying only supported for arities 2 and 3)
            'P::flatten',
            'P::toArray',
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return P::pipe(
            P::curry2('explode')('\\'),
            'P::last',
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return P::toArray(P::map(
            P::pipe(
                P::curry2('explode')(':'),
                P::map(function ($i) {
                    return (int)$i;
                }),
                'P::toArray', // generator produced by default, must convert them before passing to array functions
                'array_reverse',
                P::map(function ($num, $index) { // passes index to map
                    return $num * (60 ** $index);
                }),
                'P::toArray',
                'array_sum'
            ),
            $timestamps
        ));
    }
}
