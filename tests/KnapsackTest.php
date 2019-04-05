<?php

namespace Tests;

use DusanKasan\Knapsack\Collection;
use Tests\Toys\Route;

/**
 * dusank/knapsack
 */
class KnapsackTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return Collection::from($input)
            ->map(function (int $i) {
                return $i * 2;
            })
            ->toArray();
    }

    public function routes_to_unique_cities(array $input)
    {
        return Collection::from($input)
            ->map(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            })
            ->flatten()
            ->reduce(function (array $result, string $item) { // no built-in uniqueness filter
                if (!in_array($item, $result, true)) {
                    $result[] = $item;
                }
                return $result;
            }, []);
    }

    public function class_to_method_name(string $className)
    {
        // Ugly and useless. The library is only really useful for collection processing.
        return lcfirst(
            Collection::from(explode('\\', $className))
                ->last()
        );
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return Collection::from($timestamps)
            ->map(function (string $timestamp) {
                return Collection::from(explode(':', $timestamp))
                    ->map(function (string $str) {
                        // simple ->map('intval') doesn't work because of the second argument passed
                        return (int)$str;
                    })
                    ->reverse()
                    ->values() // necessary to get indices matching the new order
                    ->map(function (int $num, int $index) {
                        return $num * (60 ** $index);
                    })
                    ->sum();
            })
            ->toArray();
    }
}