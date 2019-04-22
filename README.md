# PHP functional utility libraries - comparison

Which of the "functional utility libraries" for PHP is
most powerful/most flexible/most pleasant to work with?
This test suite should help find an answer.

## Libraries compared

* [aerophant/ramda](https://github.com/aerophant/ramda)
    - pros
        - all functions curried (solves the problem of easy referencing without name constants)
    - cons
        - no documentation
* [grrr-amsterdam/garp-functional](https://github.com/grrr-amsterdam/garp-functional)
    - pros
        - actively maintained
    - cons
        - function referencing is awkward (no name constants)
* [ihor/nspl](https://github.com/ihor/nspl)
    - pros
        - actively maintained
        - function name constants for comfortable referencing
    - cons
        - functions split across several namespaces (import management becomes tedious)
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
    - cons
        - function referencing is awkward (no name constants)
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
    - cons
        - function referencing is awkward (no name constants)
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
