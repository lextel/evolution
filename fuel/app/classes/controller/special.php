<?php
class Controller_Special extends Controller_Frontend
{

    // LOL专题
    public function action_lol() {
        $this->template->title = 'LOL英雄、皮肤、外设一元乐购！';
        $this->template->layout = View::forge('special/lol');
    }

    // game专题
    public function action_game() {
        $this->template->title = '游戏之旅一元乐购！';
        $this->template->layout = View::forge('special/game');
    }

}
