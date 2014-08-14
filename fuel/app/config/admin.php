<?php
return [
    # 0 外部人员 1 员工 10 编辑  50 组长  100 管理员
    'navs' => [
        ['name' => '管理首页', 'href' => Uri::create('/v2admin'), 'group'=>0],
        [
            'name' => '商品管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '商品分类', 'href' => Uri::create('/v2admin/cates/cate'), 'group'=>10],
                ['name' => '商品品牌', 'href' => Uri::create('/v2admin/cates/brand'), 'group'=>10],
                ['name' => '添加新商品', 'href' => Uri::create('/v2admin/items/create'), 'group'=>10],
                ['name' => '商品列表', 'href' => Uri::create('/v2admin/items/list/all'), 'group'=>1],
            ]
        ],
        [
            'name' => '广告管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加图片', 'href' => Uri::create('/v2admin/ads/create'), 'group'=>10],
                ['name' => '广告列表', 'href' => Uri::create('/v2admin/ads'), 'group'=>1],
            ]
        ],
        [
            'name' => '用户管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '管理员列表', 'href' => Uri::create('/v2admin/users'), 'group'=>50],
                ['name' => '会员列表', 'href' => Uri::create('/v2admin/members'), 'group'=>50],
                ['name' => '冻结会员', 'href' => Uri::create('/v2admin/members/black'), 'group'=>50],
                ['name' => '礼品码', 'href' => Uri::create('/v2admin/invitcodes'), 'group'=>50],
            ]
        ],
        [
            'name' => '马甲管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加马甲', 'href' => Uri::create('/v2admin/ghost/create'), 'group'=>50],
                ['name' => '马甲列表', 'href' => Uri::create('/v2admin/ghost/lists'), 'group'=>50],
                ['name' => '中奖列表', 'href' => Uri::create('/v2admin/ghost/win'), 'group'=>50],
                ['name' => '在拍列表', 'href' => Uri::create('/v2admin/ghost/sell'), 'group'=>50],
            ]
        ],
        ['name' => '晒单/物流',
             'href' => 'javascript:void(0);',
             'class'=> 'dropdown',
             'childs'=> [
                  ['name' => '晒单管理', 'href' => Uri::create('/v2admin/posts'), 'group'=>1],
                  ['name' => '物流管理', 'href' => Uri::create('/v2admin/shipping'), 'group'=>1],
             ]
        ],
        [
            'name' => '财务管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '用户消费', 'href' => Uri::create('/v2admin/moneylog/buy'), 'group'=>50],
                ['name' => '用户充值', 'href' => Uri::create('/v2admin/moneylog/recharge'), 'group'=>50],
            ]
        ],
        /*[
            'name' => 'APP管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加新APP', 'href' => Uri::create('/v2admin/apps/create'), 'group'=>10],
                ['name' => 'APP列表', 'href' => Uri::create('/v2admin/apps'), 'group'=>10],
                ['name' => 'APP日志', 'href' => Uri::create('/v2admin/applogs'), 'group'=>10],
                ['name' => 'APP图表', 'href' => Uri::create('/v2admin/applogs/report'), 'group'=>10],
            ],
        ],*/
        [
            'name' => '系统管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [

                [
                    'name' => '公告管理',
                    'href' => Uri::create('/v2admin/notices'),
                    'group'=>10
                ],
                [
                    'name' => '管理日志',
                    'href' => Uri::create('/v2admin/logs'),
                    'group'=>50
                ],
                [
                    'name' => '反馈建议',
                    'href' => Uri::create('v2admin/suggests'),
                    'group' => 10,
                ]
            ],
        ],
    ],
    #使用权限设置 action=>group
    # 0 外部人员 1 员工 10 编辑  50 组长  100 管理员
    'rights' =>[
        ['controller'=>'Controller_V2admin',
         'action'=>['index'=>0],
        ],
        ['controller'=>'Controller_V2admin_Ads',
         'action'=>[
            'index'=>1,
            'create'=>10,
            'upload'=>10,
            'add'=>10,
            'edit'=>10,
            'update'=>10,
            'delete'=>10,
          ]
        ],

        ['controller'=>'Controller_V2admin_Cates',
         'action'=>[
            'cate'=>10,
            'brand'=>10,
            'brands'=>10,
            'createBrand'=>10,
            'createCate'=>10,
            'edit'=>10,
            'delete'=>10,
            'upload'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Ghost',
         'action'=>[
            'index'=>50,
            'lists'=>50,
            'create'=>50,
            'multi'=>50,
            'add'=>50,
            'getedit'=>50,
            'edit'=>50,
            'win'=>50,
            'forcelogin'=>50,
            'gopost'=>50,
            'delete'=>50,
            'sell'=>50,
            'order'=>50,
            'avatarUpload'=>50,
            'multiUpload'=>50,
            'csvUpload'=>50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Invitcodes',
         'action'=>[
            'index'=>50,
            'create'=>50,
            'delete'=>50,
            'outcodes'=>50,
            'outcsvfile'=>50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Items',
         'action'=>[
            'index'=>1,
            'list'=>1,
            'view'=>10,
            'create'=>10,
            'add'=>10,
            'edit'=>10,
            'update'=>10,
            'delete'=>10,
            'upload'=>10,
            'editorUpload'=>10,
            'check'=>10,
            'isPass'=>10,
            'sell'=>10,
            'notPass'=>10,
            'resell'=>10,
            'restore'=>10,
            'isRecommend'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Logs',
         'action'=>[
            'index'=>50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Members',
         'action'=>[
            'index'=>50,
            'black'=>50,
            'view'=>50,
            'disable'=>50,
            'enable'=>50,
            'delete'=>50,
            'sms' => 50,
            'smsget' => 50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Moneylog',
         'action'=>[
            'buy'=>50,
            'recharge'=>50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Notices',
         'action'=>[
            'index'=>10,
            'view'=>10,
            'create'=>10,
            'add'=>10,
            'edit'=>10,
            'update'=>10,
            'delete'=>10,
            'editorUpload'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Posts',
         'action'=>[
            'index'=>1,
            'view'=>10,
            'edit'=>10,
            'delete'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Shipping',
         'action'=>[
            'index'=>1,
            'view'=>10,
            'ship'=>10,
            'save'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Users',
         'action'=>[
            'index'=>50,
            'create'=>50,
            'add'=>50,
            'edit'=>50,
            'update'=>50,
            'delete'=>50,
          ]
        ],
        ['controller'=>'Controller_V2admin_Suggests',
         'action'=>[
            'index'=>10,
            'view'=>10,
            'pass'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Apps',
         'action'=>[
            'index'=>10,
            'view'=>10,
            'create'=>10,
            'edit'=>10,
            'delete'=>10,
            'publish'=>10,
            'uploadimg'=>10,
          ]
        ],
        ['controller'=>'Controller_V2admin_Applogs',
         'action'=>[
            'index'=>10,
            'report'=>10,
          ]
        ],
    ]

];
