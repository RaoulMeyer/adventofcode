<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 13/12/2015
 * Time: 21:49
 */

$input = file_get_contents("input");

$i = 0;

while (substr(md5($input . $i), 0, 6) !== "000000") {
    $i++;
}

echo $i;