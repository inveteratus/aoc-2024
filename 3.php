<?php

$input = trim(file_get_contents('3.in'));
$parts = preg_split('/don\'t\(\)/', $input);
$sum = solve($parts[0]);

array_shift($parts);

foreach ($parts as $part) {
    $split = preg_split('/do\(\)/', $part);
    array_shift($split);
    $sum += solve(implode('', $split));
}

echo solve($input) . PHP_EOL;
echo $sum . PHP_EOL;

function solve(string $input): int
{
    preg_match_all('/mul\((\d+),(\d+)\)/', $input, $matches, PREG_SET_ORDER);

    return array_sum(array_map(fn ($match) => $match[1] * $match[2], $matches));
}
