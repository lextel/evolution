<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route
    
    'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    //'account(/:user_id)?' => array('account/index', 'user_id'=>'index'),
    'signin' => 'center/signin',
    'signup' => 'center/signup',
    'signout' => 'center/signout',

	'u' => 'member/index',
	'u/(\d+)' => 'welcome/hello',
	'u/address' => 'member/address',
	'u/avatar' => 'member/avatar',
	'u/passwd' => 'member/changepassword',
	'u/passwd/forgot' => 'center/forgotpassword',
	'u/profile' => 'member/profile',
    'u/orders' => 'orders/my',
    'u/friends' => 'friends/my',
    'u/follow' => 'friends/follow',
    'u/unfollow' => 'friends/unfollow',
    'm/(\d+)'=> 'items/view/$1',
    'm' => 'items/index',
);

