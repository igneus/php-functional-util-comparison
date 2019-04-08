# PHP functional utility libraries - comparison

Which of the "functional utility libraries" for PHP is
most powerful/most flexible/most pleasant to work with?
This test suite should help find an answer.

## Libraries compared

* [dusank/knapsack](https://github.com/DusanKasan/Knapsack)
* [grrr-amsterdam/garp-functional](https://github.com/grrr-amsterdam/garp-functional)
* [ihor/nspl](https://github.com/ihor/nspl)
* [kilbiller/fphp](https://github.com/kilbiller/fphp)
* [lambdish/phunctional](https://github.com/Lambdish/phunctional)
* [lodash-php/lodash-php](https://github.com/lodash-php/lodash-php)
* [lstrojny/functional-php](https://github.com/lstrojny/functional-php)
* [mpetrovich/dash](https://github.com/mpetrovich/dash)

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
