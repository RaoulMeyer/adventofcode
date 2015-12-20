
<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 20/12/2015
 * Time: 10:22
 */

class AsyncOperation extends Thread {

    private $start;
    private $targetNumber;
    private $startTime;

    public function __construct($start, $targetNumber, $startTime) {
        $this->start = $start;
        $this->targetNumber = $targetNumber;
        $this->startTime = $startTime;
    }

    public function run() {
        if ($this->start) {
            $start = intval($this->start);
            for ($i = $start; $i < $start + 1000; $i++) {
                $presents = $this->getPresents($i);
                if ($presents > $this->targetNumber) {
                    echo "Found: " . $i . "\n";
                    echo (microtime(true) - $this->startTime) . " seconds\n";
                }
            }
        }
    }

    private function getPresents($number) {
        $totalPresents = 0;

        $dividers = array();

        for ($i = 1; $i <= sqrt($number) + 1; $i++) {
            if ($number % $i === 0) {
                $dividers[] = $i;
            }
        }

        foreach ($dividers as $divider) {
            $totalPresents += 10 * $divider;
            if ($divider != $number / $divider) {
                $totalPresents += 10 * ($number / $divider);
            }
        }

        return $totalPresents;
    }
}

$input = 36000000;

$tasks = array();

$startTime = microtime(true);

for ($i = 0; $i < 100000000; $i += 1000) {
    $tasks[] = new AsyncOperation($i, $input, $startTime);
}

foreach ($tasks as $task) {
    $task->start();
}