<?php
return array(
    '_root_'  => 'index/index',  // The default route
    '_404_'   => 'error/404',    // The main 404 route
    '_500_'   => 'error/500',    // The main 500 route

    'totalbuycount' => 'index/totalCount',

    'signin' => 'center/signin',
    'signup' => 'center/signup',
    'signout' => 'center/signout',

    'u/(\d+)' => 'home/index/$1',
    'u/(\d+)/orders' => 'home/orders/$1',
    'u/(\d+)/wins' => 'home/wins/$1',
    'u/(\d+)/posts' => 'home/posts/$1',
    'u' => 'member/index',
    'u/address' => 'member/address/index',
    'u/address/(\d+)' => 'member/address/view',
    'u/address/add' => 'member/address/add',
    'u/address/delete/(\d+)' => 'member/address/delete/$1',
    'u/getavatar' => 'member/getavatar',
    'u/avatar' => 'member/avatar',
    'u/avatar/upload' => 'member/avatarUpload',
    'u/getprofile' => 'member/getprofile',
    'u/profile' => 'member/profile',
    'u/passwd' => 'member/changepassword',
    'u/passwd/forgot' => 'member/forgotpassword',

    'u/posts' => 'member/posts/index',
    'u/noposts' => 'member/posts/noposts',
    'u/posts/p/(\d+)' => 'member/posts/index/$1',
     'u/noposts/p/(\d+)' => 'member/posts/noposts/$1',
    'u/posts/view/(\d+)' => 'member/posts/view',
    'u/posts/getadd' => 'member/posts/getadd',
    'u/posts/upload' => 'member/posts/upload',
    'u/posts/add' => 'member/posts/add',
    'u/posts/edit/(\d+)' => 'member/posts/edit/$1',
    'u/posts/delete/(\d+)' => 'member/posts/delete/$1',

    'u/orders' => 'member/orders/my',
    'u/orders/p/(\d+)' => 'member/orders/my/$1',
    'u/wins' => 'member/lottery/index',
    'u/win/p/\d+' => 'member/lottery/index/$1',
    'u/recharge' => 'member/recharge',
    'u/moneylog' => 'member/moneylog/rechargeIndex',
    'u/moneylog/p/(\d+)' => 'member/moneylog/rechargeIndex/$1',
    'u/moneylog/b/(\d+)' => 'member/moneylog/buyIndex/$1',

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
    'm/search/:title' => 'items/search',

    'p' => 'posts/index',
    'p/up/(\d+)' => 'posts/up/$1',
    'p/p/(\d+)' => 'posts/index/$1',
    'p/s/(\w+)?' => 'posts/sort/$1',
    'p/s/(\w+)/p/(\d+)' => 'posts/sort/$1/$2',
    'p/(\d+)' => 'posts/view/$1',
    'comment/(\d+)' => 'comment/index/$1',
    'comment/(\d+)/p/(\d+)' => 'comment/index/$1/$2',
    'comment/(\d+)/add' => 'member/comments/add/$1',

    'w' => 'wins/index',
    'w/p/(\d+)' => 'wins/index/$1',
    'w/(\d+)' => 'wins/view/$1',

    'l' => 'orders/index',
    'l/joined' => 'orders/joined',
    'l/posts' => 'posts/posts',
    'l/phases' => 'items/phases',

    'image/:size/:link' => 'image/index',

);

