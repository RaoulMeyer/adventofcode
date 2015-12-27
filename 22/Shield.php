<?php

/**
 * Created by PhpStorm.
 * User: Raoul
 * Date: 25/12/2015
 * Time: 10:41
 */
class Shield {

    private $turnsLeft = 0;
    public function castSpell($data) {
        $data->ownMana -= 113;
        $data->usedMana += 113;
        $this->turnsLeft = 6;
        $data->ownArmor += 7;
        return $data;
    }

    public function useTurn($data) {
        $this->turnsLeft--;
        if ($this->turnsLeft == 0) {
            $data->ownArmor -= 7;
        }
        return $data;
    }

    public function canCast($data) {
        return $this->turnsLeft <= 0 && $data->ownMana >= 113;
    }
}