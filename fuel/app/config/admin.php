<?php
return [
    'navs' => [
        ['name' => '管理首页', 'href' => Uri::create('/v2admin'), 'group'=>0],
        [
            'name' => '商品管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加商品', 'href' => Uri::create('/v2admin/items/create'), 'group'=>10],
                ['name' => '所有商品列表', 'href' => Uri::create('/v2admin/items/list/all'), 'group'=>1],
                ['name' => '待审核商品列表', 'href' => Uri::create('/v2admin/items/list/uncheck'), 'group'=>1],
                ['name' => '显示中的商品', 'href' => Uri::create('/v2admin/items/list/show'), 'group'=>1],
                ['name' => '运行中商品列表', 'href' => Uri::create('/v2admin/items/list/active'), 'group'=>1],
                ['name' => '已揭晓商品列表', 'href' => Uri::create('/v2admin/items/list/open'), 'group'=>1],
                ['name' => '审核不通过商品列表', 'href' => Uri::create('/v2admin/items/list/unpass'), 'group'=>1],
                ['name' => '已完成商品列表', 'href' => Uri::create('/v2admin/items/list/finish'), 'group'=>1],
                ['name' => '已删除商品列表', 'href' => Uri::create('/v2admin/items/list/delete'), 'group'=>1],
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
                ['name' => '管理员列表', 'href' => Uri::create('/v2admin/users'), 'group'=>10],
                ['name' => '会员列表', 'href' => Uri::create('/v2admin/members'), 'group'=>1],
                ['name' => '冻结会员', 'href' => Uri::create('/v2admin/members/black'), 'group'=>1],
                ['name' => '邀请码', 'href' => Uri::create('/v2admin/invitcodes'), 'group'=>1],
            ]
        ],
        [
            'name' => '马甲管理', 
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加马甲', 'href' => Uri::create('/v2admin/ghost/create'), 'group'=>10],
                ['name' => '马甲列表', 'href' => Uri::create('/v2admin/ghost/lists'), 'group'=>1],
                ['name' => '中奖列表', 'href' => Uri::create('/v2admin/ghost/win'), 'group'=>1],
                ['name' => '在拍列表', 'href' => Uri::create('/v2admin/ghost/sell'), 'group'=>1],
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
                ['name' => '用户消费', 'href' => Uri::create('/v2admin/moneylog/buy'), 'group'=>1],
                ['name' => '用户充值', 'href' => Uri::create('/v2admin/moneylog/recharge'), 'group'=>1],
            ]
        ],

        [
            'name' => '系统管理', 
            'href' => 'javascript:void(0);', 
            'class' => 'dropdown',
            'childs' => [
                ['name' => '商品分类', 'href' => Uri::create('/v2admin/cates/cate'), 'group'=>1],
                ['name' => '商品品牌', 'href' => Uri::create('/v2admin/cates/brand'), 'group'=>1],
                [
                    'name' => '公告管理',
                    'href' => Uri::create('/v2admin/notices'),
                    'group'=>1
                ],
                [
                    'name' => '管理日志',
                    'href' => Uri::create('/v2admin/logs'),
                    'group'=>10
                ],
            ],
        ],

    ]
];
