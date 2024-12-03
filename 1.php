<?php

$in = trim(file_get_contents('1.in'));
$in = array_map(fn($line) => array_map('intval', explode(' ', preg_replace('/\s+/', ' ', $line))), explode("\n", $in));

$left = array_map(fn ($item) => $item[0], $in);
$right = array_map(fn ($item) => $item[1], $in);

sort($left);
sort($right);

$final = [];

foreach ($left as $key => $value) {
    $final[] = [$value, $right[$key]];
}

$total = 0;
foreach ($final as $item) {
    $total += abs($item[0] - $item[1]);
}

echo "Part 1 : $total \n";

$total = 0;
foreach ($left as $key => $value) {
    $count = count(array_filter($right, fn ($item) => $item === $value));
    $total += $value * $count;
}

echo "Part 2 : $total \n";
