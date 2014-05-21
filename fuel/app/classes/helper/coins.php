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
            $coins .= $gold . \Config::get('unit2');

        if(!$onlyGold) {
            $silver = $points%$point;
            $coins .= $silver . \Config::get('unit4');
        }

        return $coins;
    }

     /**
     * 显示金钱
     *
     * @param $points 点数
     * @param $onlyGold 只显示元宝
     *
     */
    public static function showIconCoins($points, $onlyGold = false) {
        \Config::load('common');

        $point = \Config::get('point');
        $gold = floor($points/$point);

        $coins = '';
        if(!empty($gold))
            $coins .= \Config::get('unit') . $gold . \Config::get('unit2');

        if(!$onlyGold) {
            $silver = $points%$point;
            $coins .= \Config::get('unit3') . $silver . \Config::get('unit4');
        }

        return $coins;
    }
}
