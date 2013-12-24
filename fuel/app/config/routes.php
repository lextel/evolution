<?php
return array(
    '_root_'  => 'index/index',  // The default route
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
     'u/posts/p/(\d+)' => 'member/posts/index/$1',
     'u/posts/view/(\d+)' => 'member/posts/view',
     'u/posts/getadd' => 'member/posts/getadd',
     'u/posts/add' => 'member/posts/add',
     'u/posts/edit/(\d+)' => 'member/posts/edit',
     'u/posts/delete/(\d+)' => 'member/posts/delete/$1',

    'u/orders' => 'orders/my',
    'u/win' => 'member/lottery/index',
    'u/win/p/\d+' => 'member/lottery/index/$1',
    'u/friends' => 'friends/my',
    'u/follow' => 'friends/follow',
    'u/unfollow' => 'friends/unfollow',

    'm/(\d+)' => 'items/view/$1',
    'm' => 'items/index',
    'm/p/:page' => 'items/index',
    'm/s/:sort/p/:page' => 'items/index',
    'm/s/:sort' => 'items/index',
    'm/c/:cate_id/b/:brand_id/s:sort/p/:page' => 'items/index',
    'm/c/:cate_id/b/:brand_id/s:sort' => 'items/index',
    'm/c/:cate_id/s/:sort/p/:page' => 'items/index',
    'm/c/:cate_id/s/:sort' => 'items/index',
    'm/c/:cate_id/b/:brand_id/p/:page' => 'items/index',
    'm/c/:cate_id/b/:brand_id' => 'items/index',
    'm/c/:cate_id/p/:page' => 'items/index',
    'm/c/:cate_id' => 'items/index',

    'p' => 'posts/index',
    'p/up/(\d+)' => 'posts/up/$1',
    'p/p/(\d+)' => 'posts/index/$1',
    'p/s/(\w+)?' => 'posts/sort/$1',
    'p/s/(\w+)/p/(\d+)' => 'posts/sort/$1/$2',
    'p/(\d+)' => 'posts/view/$1',
    'comment/(\d+)' => 'comments/index/$1',
    'comment/(\d+)/p/(\d+)' => 'comments/index/$1/$2',
    'comment/(\d+)/add' => 'member/comments/add/$1',


);

