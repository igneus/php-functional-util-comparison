<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Toys\Route;

/**
 * Defines examples and their default (empty) implementation
 */
abstract class BaseTestCase extends TestCase
{
    public function examples()
    {
        return [
            // basic 'map' example: multiply each array item by 2
            [
                'multiply_by_two',
                [1, 8, 91],
                [2, 16, 182],
            ],

            // collect values from two different properties of each item, take only unique ones
            [
                'routes_to_unique_cities',
                [
                    new Route('Paris', 'London'),
                    new Route('London', 'Paris'),
                    new Route('Prague', 'Paris'),
                    new Route('Prague', 'Moscow'),
                    new Route('Moscow', 'London'),
                ],
                ['Paris', 'London', 'Prague', 'Moscow'],
            ],

            // take part of a string, change it from ClassCamelCase to methodCamelCase
            [
                'class_to_method_name',
                'Namespace1\Namespace2\Namespace3\SomeMethod',
                'someMethod'
            ],

            // split strings, cast them to integers and calculate
            [
                'timestamps_to_seconds',
                ['00:00:00', '00:01:30', '01:00:02', '19:55:48'],
                [0, 90, 3602, 71748],
            ],

            // take int[][], from each "row" select second odd number (take 1 if there is no second odd number)
            // and multiply two and two
            [
                'second_odd_numbers',
                [
                    // 1 * 5 = 5
                    [1, 1], // 1
                    [3, 5], // 5

                    // 9 * 1 = 9
                    [1, 9, 11, 13], // 9
                    [], // 1

                    // 1 * 1 = 1
                    [2, 4, 6, 8], // 1
                    [1, 2, 4, 6], // 1

                    // -3 * 3 = -9
                    [-1, -3], // -3
                    [2, 4, 6, 8, 1, 10, 12, 14, 3, 16, 18, 5, 7], // 3
                ],
                [5, 9, 1, -9]
            ]
        ];
    }

    /**
     * @dataProvider examples
     */
    public function test($methodName, $input, $expectedResult)
    {
        if (!method_exists($this, $methodName)) {
            self::markTestIncomplete();
        }

        self::assertEquals(
            $expectedResult,
            $this->{$methodName}($input)
        );
    }
}