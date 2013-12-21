<?php

class View_Posts_comment extends Viewmodel {

    public function view() {
       
       //获得商品标题
       $this->getTopComment = function($commentid) {
           $comment = Model_Comment::find($commentid);          
           return $comment;
       };
       
    }
    
}

