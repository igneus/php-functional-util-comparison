# PHP functional utility libraries - comparison

![Build Status](https://github.com/igneus/php-functional-util-comparison/actions/workflows/ci.yml/badge.svg)

Which of the "functional utility libraries" for PHP is
most powerful/most flexible/most pleasant to work with?
This test suite should help find an answer.

## Libraries compared

* [aerophant/ramda](https://github.com/aerophant/ramda)
    - pros
        - all functions curried (solves the problem of easy referencing without name constants)
    - cons
        - no documentation
* [daveross/functional-programming-utils](https://github.com/daveross/functional-programming-utils)
    - pros
    - cons
        - probably stalled (last commit 2016)
        - no collection utilities (map, flatMap, flatten, ...)
* [grrr-amsterdam/garp-functional](https://github.com/grrr-amsterdam/garp-functional)
    - pros
        - actively maintained
    - cons
* [ihor/nspl](https://github.com/ihor/nspl)
    - pros
        - actively maintained
        - function name constants for comfortable referencing
    - cons
        - functions split across several namespaces (import management becomes tedious)
* [kapolos/pramda](https://github.com/kapolos/pramda)
    - pros
        - passes index to map
    - cons
        - no stable release yet
        - `class P` not properly namespaced
        - README says "P.S. 1: Automatically Curried Functions", but it's unfortunately not true for all functions where it would be useful
        - very limited support for manual currying (see what `curryN()` really does)
* [kilbiller/fphp](https://github.com/kilbiller/fphp)
    - pros
        - all functions curried (solves the problem of easy referencing without name constants)
    - cons
        - probably stalled (last commit 2017)
* [krak/fn](https://github.com/krakphp/fn)
    - pros
        - actively maintained
        - each function provided both curried and uncurried
    - cons
        - most collection operations are implemented as generators (makes chaining awkward)
* [lambdish/phunctional](https://github.com/Lambdish/phunctional)
    - pros
        - actively maintained
        - `map` callback gets collection index passed
* [lodash-php/lodash-php](https://github.com/lodash-php/lodash-php)
    - pros
        - actively maintained
        - `map` callback gets collection index passed
    - cons
        - basic function composition features (like `compose`/`pipe`) missing
        - many very specific utility functions
* [lstrojny/functional-php](https://github.com/lstrojny/functional-php)
    - pros
        - actively maintained
        - `map` callback gets collection and collection index passed
    - cons
        - function referencing is slightly less convenient (function name constants are not in the same
          namespace as the functions themselves, they are class constants of the `Functional\Functional` class)
* [phamda/phamda](https://github.com/mpajunen/phamda)
    - pros
        - all functions curried (solves the problem of easy referencing without name constants)
    - cons
        - probably stalled (last commit 2017)

## Project structure

`tests/BaseTestCase.php` defines test cases, each other file in the `tests/` directory
provides their implementation using one of the compared libraries
(and PHP standard library as necessary).

## Usage

```
$ composer install
$ vendor/bin/phpunit
```

## License

This work is released under the
[CC0 "No Rights Reserved"](https://creativecommons.org/share-your-work/public-domain/cc0/)
license.
