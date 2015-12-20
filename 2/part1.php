<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 13/12/2015
 * Time: 21:25
 */

$input = file_get_contents("input");

$presents = explode("\n", $input);

$paperNeeded = 0;

foreach ($presents as $present) {
    list($l, $w, $h) = explode("x", trim($present));

    $paperNeeded += 2 * $l * $w + 2 * $w * $h + 2 * $h * $l;
    $paperNeeded += min($l * $w, $w * $h, $h * $l);
}

echo $paperNeeded;