<?php

class View_V2admin_Gifts_index extends ViewModel
{
    public function view()
    {
        $this->getGameName = function($gameId) {
            $game = Model_Giftgame::find($gameId);
            return isset($game->name) ? $game->name : '';
        };
    }
}
