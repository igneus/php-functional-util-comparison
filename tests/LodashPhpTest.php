<?php

namespace Tests;

use _;

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
}