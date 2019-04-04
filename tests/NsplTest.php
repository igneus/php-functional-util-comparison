<?php

namespace Tests;

use nspl\a;
use nspl\f;
use nspl\op;

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
}