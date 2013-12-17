<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	//'account(/:user_id)?' => array('account/index', 'user_id'=>'index'),
	'signin' => 'center/signin',
	'signout' => 'center/signout',
	'signup' => 'center/signup',

	'center' => 'member/index',

	'u' => 'member/index',
	'u/(\d+)' => 'welcome/hello',
	'u/address' => 'member/address',
	'u/avatar' => 'member/avatar',
	'u/friends' => 'friends/list',	
	'u/passwd' => 'member/changepassword',
	'u/passwd/forgot' => 'center/forgotpassword',
	'u/profile' => 'member/profile',
	'u/orders' => 'orders/my',
	
);

