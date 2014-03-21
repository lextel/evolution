<?php

namespace Helper;

class Coins {

    /**
     * 显示金钱
     */
    public static function showCoins($points) {
        \Config::load('common');

        $point = \Config::get('point');
        $gold = floor($points/$point);

        $coins = '';
        if(!empty($gold))
            $coins .= $gold . \Config::get('unit');

        $silver = $points%$point;
        $coins .= $silver . \Config::get('unit2');

        return $coins;
    }
}
