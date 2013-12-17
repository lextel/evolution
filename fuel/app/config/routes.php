<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route
    
    'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    //'account(/:user_id)?' => array('account/index', 'user_id'=>'index'),
    'signin' => 'center/signin',
    'signup' => 'center/signup',
    'signout' => 'center/signout',
    'center' => 'member/index',
    'u/orders' => 'orders/my',
    'u/friends' => 'friends/my',
    'u/follow' => 'friends/follow',
    'u/unfollow' => 'friends/unfollow',
    'm' => 'items/index',
    'm/(\d+)' => 'items/view',
);

