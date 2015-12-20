<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 16/12/2015
 * Time: 18:29
 */

$input = file_get_contents("input");

$lines = explode("\n", $input);

$totalLength = 0;

foreach ($lines as $line) {
    $trimmedLine = trim($line);
    $length = strlen($trimmedLine);

    $actualString = $trimmedLine;
    $actualString = str_replace("\\", "\\\\", $actualString);
    $actualString = str_replace("\"", "\\\"", $actualString);

    $totalLength += strlen($actualString) + 2 - $length;
}

echo $totalLength;