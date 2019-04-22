<?php

namespace Tests;

use Aerophant\Ramda as r;
use Tests\Toys\Route;

/**
 * aerophant/ramda
 */
class AerophantRamdaTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return r\map(
            r\multiply(2),
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        return r\pipe(
            r\map(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            }),
            r\flatten(), // no flatMap
            'array_unique',
            'array_values' // reset keys
        )($input);
    }

    public function class_to_method_name(string $className)
    {
        return r\pipe(
            r\partial('explode', ['\\']),
            r\last(),
            'lcfirst'
        )($className);
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return r\map(
            r\pipe(
                r\partial('explode', [':']),
                r\map('intval'),
                r\reverse(),
                function (array $parts) { // no zip + no way to get collection keys in map()
                    $r = [];
                    foreach ($parts as $index => $p) {
                        $r[] = [$index, $p];
                    }
                    return $r;
                },
                r\map(function ($pair) {
                    list($exponent, $num) = $pair;
                    return $num * (60 ** $exponent);
                }),
                'array_sum'
            ),
            $timestamps
        );
    }
}
