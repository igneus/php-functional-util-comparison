<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Defines examples and their default (empty) implementation
 */
abstract class BaseTestCase extends TestCase
{
    public function examples()
    {
        return [
            'multiply array items by two' => [
                'multiply_by_two',
                [1, 8, 91],
                [2, 16, 182],
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