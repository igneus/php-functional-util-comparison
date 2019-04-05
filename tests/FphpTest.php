<?php

namespace Tests;

use fphp as f;
use Tests\Toys\Route;

/**
 * kilbiller/fphp
 */
class FphpTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return f\map(
            function (int $i) {
                return $i * 2;
            },
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return f\flow(
            f\flatMap(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            f\curry('array_unique'),
            f\curry('array_values') // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return f\flow(
            f\curry('explode')('\\'),
            f\last(), // "Functions with an arity of one are also curried so you can avoid using a callable to compose them"
            f\curry('lcfirst')
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return f\map(
            f\flow(
                f\curry('explode')(':'),
                f\curry(f\map())('intval'),
                f\curry('array_reverse'),
                f\zip([0, 1, 2]), // doesn't expose collection indices
                f\map(function ($pair) {
                    list($exponent, $num) = $pair;
                    return $num * (60 ** $exponent);
                }),
                f\curry('array_sum')
            ),
            $timestamps
        );
    }
}