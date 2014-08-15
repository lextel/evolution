
<?php

class View_Member_Gamecode extends Viewmodel {

    public function view(){
        $this->getGameName = function($gameId) {
        $game = Model_Giftgame::find($gameId);

        return isset($game->name) ? $game->name : '';
        };
        $this->getGiftCode = function($id) {
           $gift = Model_Gift::find($id);
           
           return isset($gift->code) ? $gift->code : '';
        };
   }
   public function set_view(){
        $this->_view = View::forge('member/gamecode/index');
   }

}
