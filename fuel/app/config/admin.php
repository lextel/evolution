<?php
return [
    'navs' => [
        ['name' => '管理首页', 'href' => Uri::create('/v2admin')],
        [
            'name' => '商品管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加商品', 'href' => Uri::create('/v2admin/items/create')],
                ['name' => '所有商品列表', 'href' => Uri::create('/v2admin/items/list/all')],
                ['name' => '待审核商品列表', 'href' => Uri::create('/v2admin/items/list/uncheck')],
                ['name' => '显示中的商品', 'href' => Uri::create('/v2admin/items/list/show')],
                ['name' => '运行中商品列表', 'href' => Uri::create('/v2admin/items/list/active')],
                ['name' => '已揭晓商品列表', 'href' => Uri::create('/v2admin/items/list/open')],
                ['name' => '审核不通过商品列表', 'href' => Uri::create('/v2admin/items/list/unpass')],
                ['name' => '已完成商品列表', 'href' => Uri::create('/v2admin/items/list/finish')],
                ['name' => '已删除商品列表', 'href' => Uri::create('/v2admin/items/list/delete')],
            ]
        ],
        [
            'name' => '广告管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加图片', 'href' => Uri::create('/v2admin/ads/create')],
                ['name' => '广告列表', 'href' => Uri::create('/v2admin/ads')],
            ]
        ],
        [
            'name' => '用户管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '管理员列表', 'href' => Uri::create('/v2admin/users')],
                ['name' => '会员列表', 'href' => Uri::create('/v2admin/members')],
                ['name' => '冻结会员', 'href' => Uri::create('/v2admin/members/black')],
                ['name' => '邀请码', 'href' => Uri::create('/v2admin/invitcodes')],
            ]
        ],
        [
            'name' => '马甲管理', 
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加马甲', 'href' => Uri::create('/v2admin/ghost/create')],
                ['name' => '马甲列表', 'href' => Uri::create('/v2admin/ghost/lists')],
                ['name' => '中奖列表', 'href' => Uri::create('/v2admin/ghost/win')],
                ['name' => '在拍列表', 'href' => Uri::create('/v2admin/ghost/sell')],
            ]
        ],
        ['name' => '晒单管理', 'href' => Uri::create('/v2admin/posts')],
        ['name' => '物流管理', 'href' => Uri::create('/v2admin/shipping')],
        [
            'name' => '财务管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '用户消费', 'href' => Uri::create('/v2admin/moneylog/buy')],
                ['name' => '用户充值', 'href' => Uri::create('/v2admin/moneylog/recharge')],
            ]
        ],

        [
            'name' => '系统管理', 
            'href' => 'javascript:void(0);', 
            'class' => 'dropdown',
            'childs' => [
                ['name' => '商品分类', 'href' => Uri::create('/v2admin/cates/cate')],
                ['name' => '商品品牌', 'href' => Uri::create('/v2admin/cates/brand')],
                [
                    'name' => '公告管理',
                    'href' => Uri::create('/v2admin/notices'),
                ],
                [
                    'name' => '管理日志',
                    'href' => Uri::create('/v2admin/logs'),
                ],
            ],
        ],

    ]
];
