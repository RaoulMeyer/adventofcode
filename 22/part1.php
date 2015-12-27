<?php
/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 9:48
 */

// 815: That's not the right answer; your answer is too low. If you're stuck, there are some general tips on the about page, or you can ask for hints on the subreddit. Please wait one minute before trying again. (You guessed 815.)
// 977: That's not the right answer; your answer is too low. If you're stuck, there are some general tips on the about page, or you can ask for hints on the subreddit. Please wait one minute before trying again. (You guessed 977.)
// 3000: That's not the right answer; your answer is too high. If you're stuck, there are some general tips on the about page, or you can ask for hints on the subreddit. Please wait one minute before trying again. (You guessed 3000.) [Return to Day 22]

require('Data.php');
require('Drain.php');
require('MagicMissile.php');
require('Poison.php');
require('Recharge.php');
require('Shield.php');

$minMana = 3000;
for ($i = 0; $i < 2000000; $i++) {
    $manaUsed = tryCombination();
    if ($manaUsed < $minMana) {
        $minMana = $manaUsed;
//        echo $minMana . "\n";
    }
}

if ($minMana != 3000) {
    file_put_contents('test' . $minMana, 'test' . $minMana);
} else {
    file_put_contents('nope' . rand(), 'nope');
}

function tryCombination() {
    $data = new Data();
    $spells = array(
        new MagicMissile(),
        new Drain(),
        new Shield(),
        new Poison(),
        new Recharge()
    );

    while(true) {
        // Player turn
        foreach ($spells as $spell) {
            $data = $spell->useTurn($data);
        }

        if ($data->usedMana > 3000) {
            return 3000;
        }

        if ($data->ownMana < 53) {
//            echo "MANA\n";
            return 3000;
        }
        $i = 0;
        do {
            if ($i > 1000) {
//                echo "NO CHOICE\n";
                return 3000;
            }
            $chosenSpell = $spells[rand(0, count($spells) - 1)];
            $i++;
        } while (!$chosenSpell->canCast($data));

//        echo get_class($chosenSpell) . "\n";

        $data = $chosenSpell->castSpell($data);

        if ($data->bossHp <= 0) {
            return $data->usedMana;
        }

        // Boss turn
        foreach ($spells as $spell) {
            $data = $spell->useTurn($data);
        }

        if ($data->bossHp <= 0) {
            return $data->usedMana;
        }

        $data->ownHp -= $data->bossDmg - $data->ownArmor;

        if ($data->ownHp <= 0) {
            return 3000;
        }
    }
}

