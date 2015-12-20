<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 13/12/2015
 * Time: 21:15
 */

$input = file_get_contents("input");

$result = substr_count($input, "(") - substr_count($input, ")");

echo $result;