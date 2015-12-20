<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 16/12/2015
 * Time: 23:15
 */

$input = file_get_contents("input");

$data = json_decode($input, true);

$sum = 0;
$array = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));
foreach($array as $key => $value) {
    if(is_integer($value)) {
        $sum += $value;
    }
}

echo $sum;