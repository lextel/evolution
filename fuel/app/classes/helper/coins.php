<?php

namespace Helper;

class Coins {

    /**
     * 显示金钱
     *
     * @param $points 点数
     * @param $onlyGold 只显示元宝
     *
     */
    public static function showCoins($points, $onlyGold = false) {
        \Config::load('common');

        $point = \Config::get('point');
        $gold = floor($points/$point);

        $coins = '';
        if(!empty($gold))
            $coins .= $gold . \Config::get('unit');

        if(!$onlyGold) {
            $silver = $points%$point;
            $coins .= $silver . \Config::get('unit2');
        }

        return $coins;
    }
}
