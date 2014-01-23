<?php

class View_Orders_index extends Viewmodel
{
    public function view()
    {

    }

    public function set_view(){
        $this->_view = View::forge('orders/index');
   }
}