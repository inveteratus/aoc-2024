<?php

$input = trim(file_get_contents('4.in'));

$matrix = array_map('str_split', explode("\n", $input));
$width = count($matrix[0]);
$height = count($matrix);
$found1 = 0;
$found2 = 0;

for ($r = 0; $r < $height; $r++) {
    for ($c = 0; $c < $width; $c++) {
        $found1 += check1($matrix, $c, $r, $width, $height);
        $found2 += check2($matrix, $c, $r, $width, $height);
    }
}

echo $found1 . "\n";
echo $found2 . "\n";

function check1(array $matrix, int $c, int $r, int $width, int $height): int
{
    $found = 0;

    $map = [
        [-1, -1],
        [-1, 0],
        [-1, 1],
        [0, -1],
        [0, 1],
        [1, -1],
        [1, 0],
        [1, 1],
    ];

    if ($matrix[$r][$c] !== 'X') {
        return 0;
    }

    for ($direction = 0; $direction < 8; $direction++) {
        $x = $c;
        $y = $r;
        $matches = 0;

        foreach (['X', 'M', 'A', 'S'] as $ch) {
            if ($x < 0 || $y < 0 || $x >= $width || $y >= $height) {
                break;
            }

            if ($matrix[$y][$x] !== $ch) {
                break;
            }

            $x += $map[$direction][0];
            $y += $map[$direction][1];

            $matches++;
        }

        if ($matches === 4) {
            $found++;
        }
    }

    return $found;
}

function check2(array $matrix, int $c, int $r, int $width, int $height): int
{
    if ($matrix[$r][$c] !== 'A') {
        return 0;
    }

    if ($r === 0 || $c === 0 || $r === $height - 1 || $c === $width -1) {
        return 0;
    }

    $chars = $matrix[$r - 1][$c - 1] . $matrix[$r - 1][$c + 1] . $matrix[$r + 1][$c - 1] . $matrix[$r + 1][$c + 1];

    if (in_array($chars, ['MSMS', 'MMSS', 'SMSM', 'SSMM'])) {
        return 1;
    }

    return 0;
}
