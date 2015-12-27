<?php

/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 10:42
 */
class Poison {

    private $turnsLeft = 0;
    public function castSpell($data) {
        $data->ownMana -= 173;
        $data->usedMana += 173;
        $this->turnsLeft = 6;
        return $data;
    }

    public function useTurn($data) {
        $this->turnsLeft--;
        if ($this->turnsLeft > 0) {
            $data->bossHp -= 3;
        }
        return $data;
    }

    public function canCast($data) {
        return $this->turnsLeft <= 0 && $data->ownMana >= 173;
    }
}