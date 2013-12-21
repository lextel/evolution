<?php

class View_Posts_item extends Viewmodel {

    public function view() {
       
       //获得商品标题
       $this->getItems = function($itemid) {
           $item = Model_Item::find($itemid);          
           return $item;
       };
       
    }
    
}

