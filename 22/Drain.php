<?php

/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 10:41
 */
class Drain {
    public function castSpell($data) {
        $data->ownMana -= 73;
        $data->usedMana += 73;
        $data->bossHp -= 2;
        $data->ownHp += 2;
        return $data;
    }

    public function useTurn($data) {
        return $data;
    }

    public function canCast($data) {
        return $data->ownMana >= 73;
    }
}