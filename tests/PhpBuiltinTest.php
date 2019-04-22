<?php

namespace Tests;

use Tests\Toys\Route;

/**
 * For comparison: test cases implemented using only PHP built-in functions and control structures
 */
class PhpBuiltinTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return array_map(
            function (int $i) {
                return $i * 2;
            },
            $input
        );
    }

    public function routes_to_unique_cities(array $input)
    {
        $cities = [];
        /* @var Route $route */
        foreach ($input as $route) {
            $cities[] = $route->getFrom();
            $cities[] = $route->getTo();
        }
        return array_values(array_unique($cities));
    }

    public function class_to_method_name(string $className)
    {
        $parts = explode('\\', $className);
        return lcfirst(end($parts));
    }

    public function timestamps_to_seconds(array $timestamps)
    {
        return array_map(
            function (string $timestamp) {
                $parts = array_reverse(array_map('intval', explode(':', $timestamp)), false);
                $sum = 0;
                foreach ($parts as $index => $part) {
                    $sum += $part * (60 ** $index);
                }
                return $sum;
            },
            $timestamps
        );
    }
}
