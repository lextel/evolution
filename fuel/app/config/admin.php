<?php
return [
    'navs' => [
        ['name' => '管理首页', 'href' => Uri::create('/admin')],
        [
            'name' => '系统管理', 
            'href' => 'javascript:void(0);', 
            'class' => 'dropdown',
            'childs' => [
                ['name' => '商品分类', 'href' => Uri::create('/admin/cates/cate')],
                ['name' => '商品品牌', 'href' => Uri::create('/admin/cates/brand')]
            ],
        ],
        [
            'name' => '公告管理',
            'href' => Uri::create('/admin/notices'),
        ],
        [
            'name' => '管理日志',
            'href' => Uri::create('/admin/logs'),
        ],
        [
            'name' => '用户管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '管理员列表', 'href' => Uri::create('/admin/users')],
                ['name' => '会员列表', 'href' => Uri::create('/admin/members')],
                ['name' => '冻结会员', 'href' => Uri::create('/admin/members/black')],
            ]
        ],
        [
            'name' => '广告管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加图片', 'href' => Uri::create('/admin/ads/create')],
                ['name' => '广告列表', 'href' => Uri::create('/admin/ads')],
            ]
        ],
        [
            'name' => '商品管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加商品', 'href' => Uri::create('/admin/items/create')],
                ['name' => '待审核商品列表', 'href' => Uri::create('/admin/items/list/uncheck')],
                ['name' => '运行中商品列表', 'href' => Uri::create('/admin/items/list/active')],
                ['name' => '已揭晓商品列表', 'href' => Uri::create('/admin/items/list/open')],
                ['name' => '审核不通过商品列表', 'href' => Uri::create('/admin/items/list/unpass')],
            ]
        ],
        ['name' => '晒单管理', 'href' => Uri::create('/admin/posts')],
        ['name' => '物流管理', 'href' => Uri::create('/admin/shipping')],
        [
            'name' => '财务管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '用户消费', 'href' => Uri::create('/admin/moneylog/buy')],
                ['name' => '用户充值', 'href' => Uri::create('/admin/moneylog/recharge')],
            ]
        ],
    ]
];
