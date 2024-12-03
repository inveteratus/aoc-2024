<?php

function sign(int $a)
{
    return $a < 0 ? -1 : ($a > 0 ? 1 : 0);
}

function safe(array $items)
{
    $sign = 0;

    foreach ($items as $index => $value) {
        if ($index === 0) {
            continue;
        }
        $diff = $value - $items[$index - 1];
        if (abs($diff) < 1 || abs($diff) > 3) {
            return false;
        }
        if ($index > 1) {
            if (sign($diff) !== $sign) {
                return false;
            }
        }
        $sign = sign($diff);
    }

    return true;
}

function array_without_index(array $array, int $index): array
{
    $result = [];
    foreach ($array as $key => $value) {
        if ($key !== $index) {
            $result[] = $value;
        }
    }
    return $result;
}

function safe2(array $items)
{
    if (safe($items)) {
        return true;
    }

    for ($i = 0, $count = count($items); $i < $count; $i++) {
        $test = array_without_index($items, $i);
        if (safe($test)) {
            return true;
        }
    }

    return false;
}

$lines = trim(file_get_contents('2.in'));
$lines = array_map(fn($line) => array_map('intval', explode(' ', preg_replace('/\s+/', ' ', $line))), explode("\n", $lines));

$count = 0;
foreach ($lines as $line) {
    if (safe($line)) {
        $count++;
    }
}
echo "Part 1 : $count \n";

$count = 0;
foreach ($lines as $line) {
    if (safe2($line)) {
        $count++;
    }
}
echo "Part 2 : $count \n";

