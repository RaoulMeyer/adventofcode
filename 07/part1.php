<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 14/12/2015
 * Time: 19:54
 */

$input = file_get_contents("input");

$lines = explode("\n", $input);

$values = array();
foreach ($lines as $line) {
    $parts = explode("->", $line);
    $expression = trim($parts[0]);

    $words = explode(" ", $expression);
    foreach ($words as $key => $word) {
        if (!is_numeric($word) && strtolower($word) == $word) {
            $words[$key] = '_' . trim($words[$key]) . '_';
        }
    }
    $expression = implode(" ", $words);

    $values['_' . trim($parts[1]) . '_'] = trim($expression);
}

while (!valuesAreIntegers($values)) {
    $values = evaluateAllValues($values);
    $values = replaceAllValues($values);

    $totalInts = 0;

    foreach ($values as $label => $value) {
        if (is_numeric($value)) {
            $totalInts++;
        }
    }
}

var_dump($values['_a_']);

function valuesAreIntegers($values) {
    foreach ($values as $value) {
        if (!is_numeric($value)) {
            return false;
        }
    }
    return true;
}

function replaceAllValues($values) {
    $replace = array();
    foreach ($values as $label => $value) {
        if (is_numeric($value)) {
            $replace[$label] = $value;
        }
    }

    foreach ($values as $label => $value) {
        foreach ($replace as $replaceLabel => $replaceValue) {
            $values[$label] = str_replace($replaceLabel, $replaceValue, $values[$label]);
        }
    }

    return $values;
}

function evaluateAllValues($values) {
    foreach ($values as $label => $value) {
        $words = explode(" ", $value);
        if (!isset($words[1])) {
            continue;
        }

        if ($words[0] === 'NOT' && is_numeric($words[1])) {
            $values[$label] = ~ intval($words[1]) + 65536;
        }

        if (!isset($words[2])) {
            continue;
        }

        if ($words[1] === 'AND' && is_numeric($words[0]) && is_numeric($words[2])) {
            $values[$label] = intval($words[0]) & intval($words[2]);
        }

        if ($words[1] === 'OR' && is_numeric($words[0]) && is_numeric($words[2])) {
            $values[$label] = intval($words[0]) | intval($words[2]);
        }

        if ($words[1] === 'LSHIFT' && is_numeric($words[0]) && is_numeric($words[2])) {
            $values[$label] = intval($words[0]) << intval($words[2]);
        }

        if ($words[1] === 'RSHIFT' && is_numeric($words[0]) && is_numeric($words[2])) {
            $values[$label] = intval($words[0]) >> intval($words[2]);
        }
    }

    return $values;
}