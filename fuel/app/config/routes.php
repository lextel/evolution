<?php
return array(
    '_root_'  => 'index/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route
    
    'signin' => 'center/signin',
    'signup' => 'center/signup',
    'signout' => 'center/signout',

    'u' => 'member/index',
    'u/(\d+)' => 'welcome/hello',
    'u/address' => 'member/address',
    'u/avatar' => 'member/avatar',
    'u/passwd' => 'member/changepassword',
    'u/passwd/forgot' => 'center/forgotpassword',
    'u/profile' => 'member/getprofile',
    'u/updateprofile' => 'member/updateprofile',
    'u/orders' => 'orders/my',
    'u/friends' => 'friends/my',
    'u/follow' => 'friends/follow',
    'u/unfollow' => 'friends/unfollow',
    'm/(\d+)' => 'items/view/$1',
    'm' => 'items/index',
    'm/c/:cate_id' => 'items/index',
    //'m/c/:cateId/p/:page' => 'items/index',
);

