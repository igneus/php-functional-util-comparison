<?php

namespace Tests;

use Functional as F;

/**
 * lstrojny/functional-php
 */
class FunctionalPhpTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return F\map(
            $input,
            function (int $i) {
                return $i * 2;
            }
        );
    }
}