<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 13:56
 */

$cmd = 'C:\xampp\php_7\php -f part1.php';
for ($i = 0; $i < 8; $i++) {
    echo $i . "\n";
    pclose(popen("start /B ". $cmd, "r"));
    sleep(1);
}