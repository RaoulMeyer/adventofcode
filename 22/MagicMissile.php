<?php

/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 10:41
 */
class MagicMissile {
    public function castSpell($data) {
        $data->ownMana -= 53;
        $data->usedMana += 53;
        $data->bossHp -= 4;
        return $data;
    }

    public function useTurn($data) {
        return $data;
    }

    public function canCast($data) {
        return $data->ownMana >= 53;
    }
}