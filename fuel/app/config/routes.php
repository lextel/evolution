<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route

    'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    'signin' => 'center/signin',
    'signup' => 'center/signup',
    'signout' => 'center/signout',

    'u' => 'member/index',
    'u/(\d+)' => 'welcome/hello',
    'u/address/index' => 'member/getaddressindex',
    'u/address/(\d+)' => 'member/getaddress',
    'u/address' => 'member/address',
    'u/getavatar' => 'member/getavatar',
    'u/avatar' => 'member/avatar',
    'u/getprofile' => 'member/getprofile',
    'u/profile' => 'member/profile',

    'u/passwd' => 'member/changepassword',
    'u/passwd/forgot' => 'member/forgotpassword',

     'u/posts' => 'member/posts/index',
     'u/posts/view/(\d+)' => 'member/posts/view',
     'u/posts/getadd' => 'member/posts/getadd',
     'u/posts/add' => 'member/posts/add',
     'u/posts/edit/(\d+)' => 'member/posts/edit',
     'u/posts/delete/(\d+)' => 'member/posts/delete',

    'u/orders' => 'orders/my',
    'u/friends' => 'friends/my',
    'u/follow' => 'friends/follow',
    'u/unfollow' => 'friends/unfollow',
    'm/(\d+)'=> 'items/view/$1',
    'm' => 'items/index',

    'p' => 'posts/index',
    'p/p/(\d+)' => 'posts/index/$1',
    'p/s(/\d+)?' => 'posts/index/$1/$2',
    'p/s(/\d+)/p/(\d+)' => 'posts/index/$1/$2',
    'p/(\d+)' => 'posts/view/$1',
    'comment/(\d+)' => 'comments/index',
    'comment/(\d+)/p/(\d+)' => 'comments/index',
    'comment/(\d+)/add' => 'member/comments/add',

);

