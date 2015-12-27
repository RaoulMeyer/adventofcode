<?php

/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 10:42
 */
class Recharge {

    private $turnsLeft = 0;
    public function castSpell($data) {
        $data->ownMana -= 229;
        $data->usedMana += 229;
        $this->turnsLeft = 5;
        return $data;
    }

    public function useTurn($data) {
        $this->turnsLeft--;
        if ($this->turnsLeft > 0) {
            $data->ownMana += 101;
        }
        return $data;
    }

    public function canCast($data) {
        return $this->turnsLeft <= 0 && $data->ownMana >= 229;
    }
}