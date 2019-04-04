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
            'multiply array items by 2' => [
                'multiply_by_two',
                [1, 8, 91],
                [2, 16, 182],
            ],
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
            ]
        ];
    }

    /**
     * @dataProvider examples
     */
    public function test($methodName, $input, $expectedResult)
    {
        if (!method_exists($this, $methodName)) {
            $this->markTestIncomplete();
        }

        $this->assertEquals(
            $expectedResult,
            $this->{$methodName}($input)
        );
    }
}