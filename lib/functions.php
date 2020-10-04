<?php

namespace FunctionalUtilTest\functions;

/*
 * Functions shared by several test cases.
 *
 * A candidate for inclusion in this file
 * - must be very general and reusable
 * - must not use any of the functional utility libraries
 */

function isOdd(int $i) {
    return 1 === abs($i % 2);
}
const isOdd = 'FunctionalUtilTest\\functions\\isOdd';
