<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	//'account(/:user_id)?' => array('account/index', 'user_id'=>'index'),
	'signin' => 'center/signin',
	'signup' => 'center/signup',
	'center' => 'member/index',
);

